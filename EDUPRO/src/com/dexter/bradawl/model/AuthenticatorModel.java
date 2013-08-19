package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.ArrayList;

import com.dexter.bradawl.dto.Address;
import com.dexter.bradawl.dto.PasswordQuestion;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.User;
import com.dexter.bradawl.util.Env;

public class AuthenticatorModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public AuthenticatorModel()
	{}
	
	/**
	 * Used internally to connect to the bradawlnew database.
	 * */
	private void connectToDB() throws Exception
	{
		closeConnection();
		
		con = Env.getConnectionBradawl();
	}
	
	/**
	 * Used internally to close the connection after use. 
	 * */
	private void closeConnection()
	{
		if(result != null)
		{
			try
			{
				result.close();
				result = null;
			}
			catch(Exception ignore){}
		}
		if(con != null)
		{
			try
			{
				con.close();
				con = null;
			}
			catch(Exception ignore){}
		}
	}
	
	/**
	 * Gets a user object based on supplied username.
	 * */
	public User getUserByUsername(String username)
	{
		User u = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call getUserByUsername(?)}");
			stored_procedure.setString(1, username);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				u = new User();
				
				u.setUser_id(result.getInt(1));
				u.setUsername(result.getString(2));
				u.setUser_password(result.getString(3));
				u.setRole_id(result.getInt(4));
				
				if(u.getRole_id() == 8)
					u.setStudent_id(result.getInt(5));
				else
					u.setStaff_id(result.getInt(5));
				
				u.setSysobj(result.getString(6));
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return u;
	}
	
	/**
	 * Change a user's password.
	 * */
	public boolean ChangePassword(int user_id, String new_password)
	{
		boolean ret = false;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_user_password_sp(?,?,?)}");
			stored_procedure.setInt(1, user_id);
			stored_procedure.setString(2, new_password);
			stored_procedure.setInt(3, -1);
			stored_procedure.registerOutParameter(3, Types.INTEGER);
			
			stored_procedure.execute();
			
			int retc = stored_procedure.getInt(3);
			if(retc == 0)
			{
				con.commit();
				ret = true;
			}
			else
			{
				con.rollback();
				ret = false;
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Creates or deletes a password question.
	 * */
	public int CreatePasswordQuestion(PasswordQuestion pq, int type)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			if(type == 1) // create
			{
				stored_procedure = con.prepareCall("{call crt_passwordquestion_sp(?,?,?,?)}");
				stored_procedure.setString(1, pq.getQuestion());
				stored_procedure.setString(2, pq.getAnswer());
				stored_procedure.setInt(3, pq.getUser_id());
				stored_procedure.setInt(4, -1);
				stored_procedure.registerOutParameter(4, Types.INTEGER);
				
				stored_procedure.execute();
				
				ret = stored_procedure.getInt(4);
			}
			else if(type == 2) // delete
			{
				stored_procedure = con.prepareCall("{call del_passwordquestion_sp(?,?)}");
				stored_procedure.setInt(1, pq.getId());
				stored_procedure.setInt(2, -1);
				stored_procedure.registerOutParameter(2, Types.INTEGER);
				
				stored_procedure.execute();
				
				ret = stored_procedure.getInt(2);
			}
			
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets a users password questions list.
	 * */
	public ArrayList<PasswordQuestion> GetUserPasswordQuestions(int user_id)
	{
		ArrayList<PasswordQuestion> list = new ArrayList<PasswordQuestion>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_passwordquestions_sp(?)}");
			stored_procedure.setInt(1, user_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				PasswordQuestion e = new PasswordQuestion();
				e.setId(result.getInt(1));
				e.setQuestion(result.getString(2));
				e.setAnswer(result.getString(3));
				e.setUser_id(result.getInt(4));
				e.setCrt_dt(result.getDate(5));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Gets a staff by its id.
	 * */
	public Staff getStaffByID(int id)
	{
		Staff e = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call getStaffByID(?)}");
			stored_procedure.setInt(1, id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				e = new Staff();
				
				e.setStaff_id(result.getInt(1));
				e.setStaff_fn(result.getString(2));
				e.setStaff_mn(result.getString(3));
				e.setStaff_ln(result.getString(4));
				e.setStaff_cat_id(result.getInt(5));
				e.setDepartment_id(result.getInt(6));
				e.setAddr_id(result.getInt(7));
				e.setStatus_id(result.getInt(8));
				
				java.sql.Date dt = result.getDate(9);
				e.setDt_employed(new java.util.Date(dt.getTime()));
			}
			
			if(e != null) // now get the address
			{
				stored_procedure = con.prepareCall("{call getAddressByID(?)}");
				stored_procedure.setInt(1, e.getAddr_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Address a = new Address();
					
					a.setAddr_id(result.getInt(1));
					a.setAddr1(result.getString(2));
					a.setAddr2(result.getString(3));
					a.setPhone1(result.getString(4));
					a.setPhone2(result.getString(5));
					a.setEmail(result.getString(6));
					
					e.setAddress(a);
				}
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return e;
	}
	
	/**
	 * Gets a student by its id.
	 * */
	public Student getStudentByID(int id)
	{
		Student e = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call getStudentByID(?)}");
			stored_procedure.setInt(1, id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				e = new Student();
				
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setAddr_id(result.getInt(5));
				e.setGender(result.getString(6));
				
				java.sql.Date dt = result.getDate(7);
				e.setDob(new java.util.Date(dt.getTime()));
				
				//e.setName_of_next_of_kin(result.getString(8));
				e.setClass_id(result.getInt(8));
				e.setDisability(result.getString(9));
				e.setPrecaution(result.getString(10));
				e.setBlood_grp(result.getString(11));
				e.setGenotype(result.getString(12));
				
				dt = result.getDate(13);
				e.setDate_enrolled(new java.util.Date(dt.getTime()));
				
				e.setStudent_status_id(result.getInt(16));
				e.setYear_graduated(result.getInt(17));
				e.setRollNumber(result.getInt(18));
			}
			
			if(e != null) // now get the address
			{
				stored_procedure = con.prepareCall("{call getAddressByID(?)}");
				stored_procedure.setInt(1, e.getAddr_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Address a = new Address();
					
					a.setAddr_id(result.getInt(1));
					a.setAddr1(result.getString(2));
					a.setAddr2(result.getString(3));
					a.setPhone1(result.getString(4));
					a.setPhone2(result.getString(5));
					a.setEmail(result.getString(6));
					
					e.setAddress(a);
				}
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return e;
	}
}
