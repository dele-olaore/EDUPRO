package com.dexter.bradawl.dto;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.Date;

import com.dexter.bradawl.util.Env;

public class Class implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;

	private int class_id;
	private int staff_id;
	private String class_level;
	private int level_num;
	private int total_no_of_students;
	private int total_male_students;
	private int total_female_students;
	private int class_discipline_id;
	private String class_group;
	private int fee_cat_id;
	private int user_id;
	
	private Date crt_dt;
	
	private String staff_nm;
	
	private int block_id;
	private String block_nm;
	
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";

	public Class()
	{
		setFee_cat_id(0);
		setStaff_id(0);
	}
	
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

	public int CreateMe()
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_class_sp(?,?,?,?,?,?,?)}");
			
			stored_procedure.setInt(1, getStaff_id());
			stored_procedure.setString(2, getClass_level());
			stored_procedure.setInt(3, getLevel_num());
			stored_procedure.setString(4, getClass_group());
			stored_procedure.setInt(5, getBlock_id());
			stored_procedure.setInt(6, getUser_id());
			stored_procedure.setInt(7, -1);
			
			stored_procedure.registerOutParameter(7, Types.INTEGER);
			
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(7);
			switch(ret)
			{
				case 0:
				{
					con.commit();
					break;
				}
				default:
				{
					con.rollback();
					break;
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
	
	public int UpdateMe()
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_class_sp(?,?,?,?,?)}");
			
			stored_procedure.setInt(1, getClass_id());
			stored_procedure.setInt(2, getStaff_id());
			stored_procedure.setInt(3, getBlock_id());
			stored_procedure.setInt(4, getUser_id());
			stored_procedure.setInt(5, -1);
			
			stored_procedure.registerOutParameter(5, Types.INTEGER);
			
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(5);
			switch(ret)
			{
				case 0:
				{
					con.commit();
					break;
				}
				default:
				{
					con.rollback();
					break;
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
	
	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int class_id)
	{
		this.class_id = class_id;
	}

	// should validate
	public int getStaff_id()
	{
		return staff_id;
	}

	public void setStaff_id(int staff_id)
	{
		try
		{
			this.staff_id = staff_id;
		}
		catch(Exception ex)
		{
			this.staff_id = 0;
		}
	}

	public String getClass_level()
	{
		return class_level;
	}

	public void setClass_level(String class_level)
	{
		this.class_level = class_level;
	}

	public int getLevel_num()
	{
		return level_num;
	}

	public void setLevel_num(int level_num)
	{
		this.level_num = level_num;
	}

	public int getTotal_no_of_students()
	{
		return total_no_of_students;
	}

	public void setTotal_no_of_students(int total_no_of_students)
	{
		this.total_no_of_students = total_no_of_students;
	}

	public int getTotal_male_students()
	{
		return total_male_students;
	}

	public void setTotal_male_students(int total_male_students)
	{
		this.total_male_students = total_male_students;
	}

	public int getTotal_female_students()
	{
		return total_female_students;
	}

	public void setTotal_female_students(int total_female_students)
	{
		this.total_female_students = total_female_students;
	}

	public int getClass_discipline_id()
	{
		return class_discipline_id;
	}

	public void setClass_discipline_id(int class_discipline_id)
	{
		this.class_discipline_id = class_discipline_id;
	}

	public String getClass_group()
	{
		return class_group;
	}

	public void setClass_group(String class_group)
	{
		this.class_group = class_group;
	}

	public int getFee_cat_id()
	{
		return fee_cat_id;
	}

	public void setFee_cat_id(int fee_cat_id)
	{
		this.fee_cat_id = fee_cat_id;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int user_id)
	{
		this.user_id = user_id;
	}

	public Date getCrt_dt()
	{
		return crt_dt;
	}

	public void setCrt_dt(Date crt_dt)
	{
		this.crt_dt = crt_dt;
	}

	public static long getSerialversionuid()
	{
		return serialVersionUID;
	}

	public String getStaff_nm()
	{
		return staff_nm;
	}

	public void setStaff_nm(String staff_nm)
	{
		this.staff_nm = staff_nm;
	}

	public int getBlock_id()
	{
		return block_id;
	}

	public void setBlock_id(int block_id)
	{
		this.block_id = block_id;
	}

	public String getBlock_nm()
	{
		return block_nm;
	}

	public void setBlock_nm(String block_nm)
	{
		this.block_nm = block_nm;
	}
	
}