package com.dexter.bradawl.dto;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;

import com.dexter.bradawl.util.Env;

public class Grade implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int grade_id;
	private int grade_start;
	private int grade_end;
	private String grade_letter;
	private String grade_remark;
	
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";

	private String message;
	
	public Grade()
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
	 * Updates the grade in the db.
	 * */
	public int updateMe()
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call upd_grade_sp(?,?,?,?,?,?)}");
			stored_procedure.setInt(1, getGrade_id());
			stored_procedure.setInt(2, getGrade_start());
			stored_procedure.setInt(3, getGrade_end());
			stored_procedure.setString(4, getGrade_letter());
			stored_procedure.setString(5, getGrade_remark());
			stored_procedure.setInt(6, -1);
			
			stored_procedure.registerOutParameter(6, Types.INTEGER);
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(6);
			
			switch(ret)
			{
				case 0:
				{
					con.commit();
					setMessage("Update successful");
					break;
				}
				default:
				{
					con.rollback();
					setMessage("Failed to update");
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
		
		return ret;
	}
	
	public int getGrade_id()
	{
		return grade_id;
	}

	public void setGrade_id(int gradeId)
	{
		grade_id = gradeId;
	}

	public int getGrade_start()
	{
		return grade_start;
	}

	public void setGrade_start(int gradeStart)
	{
		grade_start = gradeStart;
	}

	public int getGrade_end()
	{
		return grade_end;
	}

	public void setGrade_end(int gradeEnd)
	{
		grade_end = gradeEnd;
	}

	public String getGrade_letter()
	{
		return grade_letter;
	}

	public void setGrade_letter(String gradeLetter)
	{
		grade_letter = gradeLetter;
	}

	public String getGrade_remark()
	{
		return grade_remark;
	}

	public void setGrade_remark(String gradeRemark)
	{
		grade_remark = gradeRemark;
	}

	public String getMessage()
	{
		return message;
	}

	public void setMessage(String message)
	{
		this.message = message;
	}
	
}