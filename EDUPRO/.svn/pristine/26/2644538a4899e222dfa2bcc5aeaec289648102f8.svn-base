package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.RefModel;

public class StudentMedical
{
	private int id;
	private int student_id;
	private int medical_test_id;
	private int medical_result_id;
	private String result_summary;
	private int user_id;
	private Date crt_dt;
	
	private String medical_test_nm;
	private String medical_result_nm;
	
	public StudentMedical()
	{}

	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}

	public int getStudent_id()
	{
		return student_id;
	}

	public void setStudent_id(int student_id)
	{
		this.student_id = student_id;
	}

	public int getMedical_test_id()
	{
		return medical_test_id;
	}

	public void setMedical_test_id(int medical_test_id)
	{
		if(medical_test_id > 0)
		{
			ArrayList<Ref> list = new RefModel().getRefObjects(8);
			for(Ref e : list)
			{
				if(e.getId() == medical_test_id)
				{
					setMedical_test_nm(e.getName());
					break;
				}
			}
		}
		
		this.medical_test_id = medical_test_id;
	}

	public int getMedical_result_id()
	{
		return medical_result_id;
	}

	public void setMedical_result_id(int medical_result_id)
	{
		if(medical_result_id > 0)
		{
			ArrayList<Ref> list = new RefModel().getRefObjects(9);
			for(Ref e : list)
			{
				if(e.getId() == medical_result_id)
				{
					setMedical_result_nm(e.getName());
					break;
				}
			}
		}
		this.medical_result_id = medical_result_id;
	}

	public String getResult_summary()
	{
		return result_summary;
	}

	public void setResult_summary(String result_summary)
	{
		this.result_summary = result_summary;
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

	public String getMedical_test_nm()
	{
		return medical_test_nm;
	}

	public void setMedical_test_nm(String medical_test_nm)
	{
		this.medical_test_nm = medical_test_nm;
	}

	public String getMedical_result_nm()
	{
		return medical_result_nm;
	}

	public void setMedical_result_nm(String medical_result_nm)
	{
		this.medical_result_nm = medical_result_nm;
	}
	
}
