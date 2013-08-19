package com.dexter.bradawl.dto;

import java.util.Date;

public class User implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int user_id;
	private String username;
	private String user_password;
	private int role_id;
	private int staff_id;
	private int student_id;
	private int guardian_id;
	private String sysobj;
	private Date crt_dt;

	private String re_password;
	private String role_nm;
	
	private boolean resetPassword;
	private boolean createAccount;
	
	public User()
	{}

	public String getRole_nm()
	{
		return role_nm;
	}

	public void setRole_nm(String role_nm)
	{
		this.role_nm = role_nm;
	}

	public String getSysobj()
	{
		return sysobj;
	}

	public void setSysobj(String sysobj)
	{
		this.sysobj = sysobj;
	}

	public String getRe_password()
	{
		return re_password;
	}

	public void setRe_password(String re_password)
	{
		this.re_password = re_password;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int userId)
	{
		user_id = userId;
	}

	public String getUsername()
	{
		return username;
	}

	public void setUsername(String username)
	{
		this.username = username;
	}

	public String getUser_password()
	{
		return user_password;
	}

	public void setUser_password(String userPassword)
	{
		user_password = userPassword;
	}

	public int getRole_id()
	{
		return role_id;
	}

	public void setRole_id(int roleId)
	{
		role_id = roleId;
	}

	public int getStaff_id()
	{
		return staff_id;
	}

	public void setStaff_id(int staffId)
	{
		staff_id = staffId;
	}

	public int getStudent_id()
	{
		return student_id;
	}

	public void setStudent_id(int student_id)
	{
		this.student_id = student_id;
	}

	public int getGuardian_id() {
		return guardian_id;
	}

	public void setGuardian_id(int guardian_id) {
		this.guardian_id = guardian_id;
	}

	public Date getCrt_dt()
	{
		return crt_dt;
	}

	public void setCrt_dt(Date crtDt)
	{
		crt_dt = crtDt;
	}

	public boolean getResetPassword() {
		return resetPassword;
	}

	public void setResetPassword(boolean resetPassword) {
		this.resetPassword = resetPassword;
	}

	public boolean getCreateAccount() {
		return createAccount;
	}

	public void setCreateAccount(boolean createAccount) {
		this.createAccount = createAccount;
	}
	
}