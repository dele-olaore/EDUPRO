package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;

import com.dexter.bradawl.dto.User;
import com.dexter.bradawl.util.Env;

public class UserModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public UserModel()
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
				else if(u.getRole_id() == 9)
					u.setGuardian_id(result.getInt(5));
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
}
