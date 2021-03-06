package com.dexter.bradawl.dto;

import java.util.Date;

public class Attendance
{
	private int id;
	private int class_id;
	private int student_id;
	private Date date;
	private String flag;
	private boolean flagBool;
	private int user_id;
	
	private int subject_id;
	
	private String student_fn;
	private String student_mn;
	private String student_ln;
	private int rollNumber;
	
	private String class_nm, class_teacher_nm;
	private String subject_nm;
	
	public Attendance()
	{}

	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}

	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int class_id)
	{
		this.class_id = class_id;
	}

	public int getStudent_id()
	{
		return student_id;
	}

	public void setStudent_id(int student_id)
	{
		this.student_id = student_id;
	}

	public Date getDate()
	{
		return date;
	}

	public void setDate(Date date)
	{
		this.date = date;
	}

	public String getFlag()
	{
		return flag;
	}

	public void setFlag(String flag)
	{
		this.flag = flag;
	}

	public boolean getFlagBool()
	{
		return flagBool;
	}

	public void setFlagBool(boolean flagBool)
	{
		this.flagBool = flagBool;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int user_id)
	{
		this.user_id = user_id;
	}

	public int getSubject_id()
	{
		return subject_id;
	}

	public void setSubject_id(int subject_id)
	{
		this.subject_id = subject_id;
	}

	public String getStudent_fn()
	{
		return student_fn;
	}

	public void setStudent_fn(String student_fn)
	{
		this.student_fn = student_fn;
	}

	public String getStudent_mn()
	{
		return student_mn;
	}

	public void setStudent_mn(String student_mn)
	{
		this.student_mn = student_mn;
	}

	public String getStudent_ln()
	{
		return student_ln;
	}

	public void setStudent_ln(String student_ln)
	{
		this.student_ln = student_ln;
	}

	public int getRollNumber()
	{
		return rollNumber;
	}

	public void setRollNumber(int rollNumber)
	{
		this.rollNumber = rollNumber;
	}

	public String getClass_nm() {
		return class_nm;
	}

	public void setClass_nm(String class_nm) {
		this.class_nm = class_nm;
	}

	public String getClass_teacher_nm() {
		return class_teacher_nm;
	}

	public void setClass_teacher_nm(String class_teacher_nm) {
		this.class_teacher_nm = class_teacher_nm;
	}

	public String getSubject_nm() {
		return subject_nm;
	}

	public void setSubject_nm(String subject_nm) {
		this.subject_nm = subject_nm;
	}
	
}
