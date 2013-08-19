package com.dexter.bradawl.dto;

import java.util.Date;

public class Score
{
	private int id;
	private int sub_id;
	private int class_id;
	private int student_id;
	private double test_score;
	private double exam_score;
	private double attendance_score;
	private int grade_id;
	private int term_id;
	private int user_id;
	private Date crt_dt;
	
	private String type;
	
	private String student_fn;
	private String student_mn;
	private String student_ln;
	private int rollNumber;
	
	private String sub_nm;
	private String sub_desc;
	
	private String term_nm;
	private String session_nm;
	
	private double total_score;
	private Grade grade;
	
	public Score()
	{}

	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}

	public int getSub_id()
	{
		return sub_id;
	}

	public void setSub_id(int sub_id)
	{
		this.sub_id = sub_id;
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

	public double getTest_score()
	{
		return test_score;
	}

	public void setTest_score(double test_score)
	{
		this.test_score = test_score;
	}

	public double getExam_score()
	{
		return exam_score;
	}

	public void setExam_score(double exam_score)
	{
		this.exam_score = exam_score;
	}

	public double getAttendance_score() {
		return attendance_score;
	}

	public void setAttendance_score(double attendance_score) {
		this.attendance_score = attendance_score;
	}

	public int getGrade_id()
	{
		return grade_id;
	}

	public void setGrade_id(int grade_id)
	{
		this.grade_id = grade_id;
	}

	public int getTerm_id()
	{
		return term_id;
	}

	public void setTerm_id(int term_id)
	{
		this.term_id = term_id;
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

	public String getType()
	{
		if(type == null)
			type = "T";
		return type;
	}

	public void setType(String type)
	{
		this.type = type;
	}

	public String getSub_nm() {
		return sub_nm;
	}

	public void setSub_nm(String sub_nm) {
		this.sub_nm = sub_nm;
	}

	public String getSub_desc() {
		return sub_desc;
	}

	public void setSub_desc(String sub_desc) {
		this.sub_desc = sub_desc;
	}

	public double getTotal_score() {
		if(total_score == 0 && (attendance_score > 0 || test_score > 0 || exam_score > 0))
			total_score = attendance_score+test_score+exam_score;
		return total_score;
	}

	public void setTotal_score(double total_score) {
		this.total_score = total_score;
	}

	public Grade getGrade() {
		return grade;
	}

	public void setGrade(Grade grade) {
		this.grade = grade;
	}

	public String getTerm_nm() {
		return term_nm;
	}

	public void setTerm_nm(String term_nm) {
		this.term_nm = term_nm;
	}

	public String getSession_nm() {
		return session_nm;
	}

	public void setSession_nm(String session_nm) {
		this.session_nm = session_nm;
	}
	
}
