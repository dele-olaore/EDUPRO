package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;

import com.dexter.bradawl.dto.School;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.util.Env;

public class SetupModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public SetupModel()
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
	 * Saves the setup information to the database.
	 * */
	public int setupBradawl(School school, Staff staff)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call setup_sp(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}");
			
			stored_procedure.setString(1, school.getSch_nm());
			stored_procedure.setString(2, school.getSch_motto());
			stored_procedure.setString(3, school.getYear_founded());
			stored_procedure.setString(4, school.getRc_no());
			stored_procedure.setInt(5, school.getOp_type_id());
			
			stored_procedure.setString(6, school.getAddress().getAddr1());
			stored_procedure.setString(7, school.getAddress().getAddr2());
			stored_procedure.setString(8, school.getAddress().getPhone1());
			stored_procedure.setString(9, school.getAddress().getPhone2());
			stored_procedure.setString(10, school.getAddress().getEmail());
			stored_procedure.setString(11, school.getAddress().getFax());
			stored_procedure.setString(12, school.getAddress().getWebsite());
			
			stored_procedure.setString(13, staff.getStaff_fn());
			stored_procedure.setString(14, staff.getStaff_mn());
			stored_procedure.setString(15, staff.getStaff_ln());
			stored_procedure.setInt(16, staff.getStaff_cat_id());
			stored_procedure.setInt(17, staff.getDepartment_id());
			
			stored_procedure.setString(18, staff.getAddress().getAddr1());
			stored_procedure.setString(19, staff.getAddress().getAddr2());
			stored_procedure.setString(20, staff.getAddress().getPhone1());
			stored_procedure.setString(21, staff.getAddress().getPhone2());
			stored_procedure.setString(22, staff.getAddress().getEmail());
			
			stored_procedure.setString(23, staff.getUser().getUsername());
			stored_procedure.setString(24, staff.getUser().getUser_password());
			
			stored_procedure.setInt(25, -1);
			stored_procedure.registerOutParameter(25, Types.INTEGER);
			
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(25);
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
}
