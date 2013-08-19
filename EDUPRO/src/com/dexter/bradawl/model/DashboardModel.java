package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.util.ArrayList;

import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.util.Env;

public class DashboardModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	public DashboardModel()
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
	 * Gets modules for the current role.
	 * */
	public ArrayList<Ref> GetRoleModules(int role_id)
	{
		ArrayList<Ref> list = new ArrayList<Ref>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_role_modules_sp(?)}");
			stored_procedure.setInt(1, role_id);
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Ref e = new Ref();
				
				e.setId(result.getInt(1));
				e.setName(result.getString(2));
				e.setDesc(result.getString(3));
				
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
	 * Gets modules for the current role.
	 * */
	public ArrayList<Ref> GetRoleFunctionsByModule(int role_id, int module_id)
	{
		ArrayList<Ref> list = new ArrayList<Ref>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_role_functionsbymodule_sp(?, ?)}");
			stored_procedure.setInt(1, role_id);
			stored_procedure.setInt(2, module_id);
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Ref e = new Ref();
				
				e.setId(result.getInt(1));
				e.setName(result.getString(2));
				e.setMod_name(result.getString(4));
				e.setDesc(result.getString(5));
				e.setFunc_page(result.getString(6));
				e.setFunc_button(result.getString(7));
				e.setIsAction(result.getString(8));
				
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
		// 
		return list;
	}
}
