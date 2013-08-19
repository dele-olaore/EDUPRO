package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;

import com.dexter.bradawl.dto.Address;
import com.dexter.bradawl.dto.School;
import com.dexter.bradawl.util.Env;

public class OptionModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public OptionModel()
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
	 * Gets the details of the school
	 * */
	public School getSchool()
	{
		School school = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_school_sp}");
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				school = new School();
				school.setSch_id(result.getInt(1));
				school.setSch_nm(result.getString(2));
				school.setSch_motto(result.getString(3));
				school.setAddr_id(result.getInt(4));
				school.setYear_founded(result.getString(5));
				school.setRc_no(result.getString(6));
				school.setOp_type_id(result.getInt(7));
				school.setOp_type_nm(result.getString(8));
			}
			
			if(school != null)
			{
				stored_procedure = con.prepareCall("{call get_addressbyid_sp(?)}");
				stored_procedure.setInt(1, school.getAddr_id());
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
					a.setFax(result.getString(7));
					
					school.setAddress(a);
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
		
		return school;
	}
	
	/**
	 * Update school
	 * */
	public int UpdateSchool(School sch)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_school_sp(?,?,?,?,?,?)}");
			stored_procedure.setString(1, sch.getSch_nm());
			stored_procedure.setString(2, sch.getSch_motto());
			stored_procedure.setString(3, sch.getYear_founded());
			stored_procedure.setString(4, sch.getRc_no());
			stored_procedure.setInt(5, sch.getOp_type_id());
			stored_procedure.setInt(6, -1);
			stored_procedure.registerOutParameter(6, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(6);
			if(ret == 0)
			{
				con.commit();
			}
			else
			{
				con.rollback();
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
	 * Gets user option.
	 * */
	public String[] getUserOptions(int user_id)
	{
		String[] ret = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call getOptions(?)}");
			stored_procedure.setInt(1, user_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				ret = new String[1];
				ret[0] = result.getString(1);
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
	 * Set user options.
	 * */
	public void setUserOptions(String[] options, int user_id)
	{
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call setOptions(?, ?)}");
			stored_procedure.setInt(1, user_id);
			stored_procedure.setString(2, options[0]);
			
			stored_procedure.execute();
			con.commit();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
	}
}
