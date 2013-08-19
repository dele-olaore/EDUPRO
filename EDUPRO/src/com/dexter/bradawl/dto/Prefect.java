package com.dexter.bradawl.dto;

import java.util.Date;

public class Prefect
{
	private int id;
	private int session_id;
	private int prefect_id;
	private int student_id;
	private String type;
	private int user_id;
	private Date crt_dt;
	
	private String session_nm;
	private String prefect_nm;
	private Student student;
	
	public Prefect()
	{}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getSession_id() {
		return session_id;
	}

	public void setSession_id(int session_id) {
		this.session_id = session_id;
	}

	public int getPrefect_id() {
		return prefect_id;
	}

	public void setPrefect_id(int prefect_id) {
		this.prefect_id = prefect_id;
	}

	public int getStudent_id() {
		return student_id;
	}

	public void setStudent_id(int student_id) {
		this.student_id = student_id;
	}

	public String getType() {
		return type;
	}

	public void setType(String type) {
		this.type = type;
	}

	public int getUser_id() {
		return user_id;
	}

	public void setUser_id(int user_id) {
		this.user_id = user_id;
	}

	public Date getCrt_dt() {
		return crt_dt;
	}

	public void setCrt_dt(Date crt_dt) {
		this.crt_dt = crt_dt;
	}

	public String getSession_nm() {
		return session_nm;
	}

	public void setSession_nm(String session_nm) {
		this.session_nm = session_nm;
	}

	public String getPrefect_nm() {
		return prefect_nm;
	}

	public void setPrefect_nm(String prefect_nm) {
		this.prefect_nm = prefect_nm;
	}

	public Student getStudent() {
		return student;
	}

	public void setStudent(Student student) {
		this.student = student;
	}
	
}
