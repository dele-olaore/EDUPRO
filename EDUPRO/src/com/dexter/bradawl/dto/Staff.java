package com.dexter.bradawl.dto;

import java.util.Date;

public class Staff implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int staff_id;
	private String staff_fn;
	private String staff_ln;
	private String staff_mn;
	private int staff_cat_id;
	private int department_id;
	private int addr_id;
	private int status_id;
	private Date dt_employed;
	private byte[] staff_picture;
	private int user_id;
	private Date crt_dt;
	
	private String staff_cat_nm;
	private String department_nm;
	private String status_nm;
	
	private String email; // to confirm with the address email, when creating the staff user
	
	private Address address;
	private User user;
	
	private boolean hasUser;
	
	public Staff()
	{}

	public Address getAddress()
	{
		if(address == null)
		{
			address = new Address();
		}
		return address;
	}

	public void setAddress(Address address)
	{
		this.address = address;
	}

	public User getUser()
	{
		if(user == null)
		{
			user = new User();
		}
		return user;
	}

	public void setUser(User user)
	{
		this.user = user;
	}

	public int getStaff_id()
	{
		return staff_id;
	}

	public void setStaff_id(int staffId)
	{
		staff_id = staffId;
	}

	public String getStaff_fn()
	{
		return staff_fn;
	}

	public void setStaff_fn(String staffFn)
	{
		staff_fn = staffFn;
	}

	public String getStaff_ln()
	{
		return staff_ln;
	}

	public void setStaff_ln(String staffLn)
	{
		staff_ln = staffLn;
	}

	public String getStaff_mn()
	{
		return staff_mn;
	}

	public void setStaff_mn(String staffMn)
	{
		staff_mn = staffMn;
	}

	public int getStaff_cat_id()
	{
		return staff_cat_id;
	}

	public void setStaff_cat_id(int staffCatId)
	{
		staff_cat_id = staffCatId;
	}

	public int getDepartment_id()
	{
		return department_id;
	}

	public void setDepartment_id(int departmentId)
	{
		department_id = departmentId;
	}

	public int getAddr_id()
	{
		return addr_id;
	}

	public void setAddr_id(int addrId)
	{
		addr_id = addrId;
	}

	public int getStatus_id()
	{
		return status_id;
	}

	public void setStatus_id(int statusId)
	{
		status_id = statusId;
	}

	public Date getDt_employed()
	{
		return dt_employed;
	}

	public void setDt_employed(Date dtEmployed)
	{
		dt_employed = dtEmployed;
	}

	public byte[] getStaff_picture()
	{
		return staff_picture;
	}

	public void setStaff_picture(byte[] staffPicture)
	{
		staff_picture = staffPicture;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int userId)
	{
		user_id = userId;
	}

	public Date getCrt_dt()
	{
		return crt_dt;
	}

	public void setCrt_dt(Date crtDt)
	{
		crt_dt = crtDt;
	}

	public String getStaff_cat_nm()
	{
		return staff_cat_nm;
	}

	public void setStaff_cat_nm(String staff_cat_nm)
	{
		this.staff_cat_nm = staff_cat_nm;
	}

	public String getDepartment_nm()
	{
		return department_nm;
	}

	public void setDepartment_nm(String department_nm)
	{
		this.department_nm = department_nm;
	}

	public String getStatus_nm()
	{
		return status_nm;
	}

	public void setStatus_nm(String status_nm)
	{
		this.status_nm = status_nm;
	}

	public boolean getHasUser()
	{
		return hasUser;
	}

	public void setHasUser(boolean hasUser)
	{
		this.hasUser = hasUser;
	}

	public String getEmail()
	{
		return email;
	}

	public void setEmail(String email)
	{
		this.email = email;
	}
	
}