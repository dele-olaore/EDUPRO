package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

public class DayTiming
{
	private int id;
	private int day;
	private int start_time;
	private int end_time;
	private int brk_start_time;
	private int brk_end_time;
	private int session_dur;
	
	private int user_id;
	private Date crt_dt;
	
	// for form filling
	private int start_time_hr, start_time_min;
	private int end_time_hr, end_time_min;
	private int brk_start_time_hr, brk_start_time_min;
	private int brk_dur_min;
	
	private String[] days = new String[]{"Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"};
	private String day_nm;
	
	private int class_id;
	private int staff_id;
	private ArrayList<ClassSubjectDayTiming> ttable;
	
	public DayTiming()
	{}
	
	public void LoadHeaders()
	{
		ttable = new ArrayList<ClassSubjectDayTiming>();
		boolean brk_found = false, brk_end = false;;
		for(int i=start_time; i<=end_time; i+=session_dur)
		{
			if(brk_found)
			{
				i = brk_start_time;
			}
			
			if(brk_end)
			{
				i = brk_end_time;
				brk_end = false;
			}
			
			ClassSubjectDayTiming h = new ClassSubjectDayTiming();
			h.setDay(getDay());
			h.setStart_time_in_minutes(i);
			
			if(getClass_id() > 0)
			{
				h.setClass_id(getClass_id());
				h.loadSubject();
			}
			else if(getStaff_id() > 0)
			{
				h.setStaff_id(getStaff_id());
				h.loadStaffSubject();
			}
			
			if((i + session_dur >= brk_start_time) && i <= brk_start_time && !brk_found)
			{
				i = brk_start_time;
				brk_found = true;
			}
			else if(i == brk_start_time)
			{
				h.setBrk(true);
				brk_found = false;
				brk_end = true;
				i = brk_end_time;
			}
			
			ttable.add(h);
		}
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getDay() {
		return day;
	}

	public void setDay(int day) {
		if(day > 0 && day <= 7)
		{
			setDay_nm(days[day-1]);
		}
		this.day = day;
	}

	public int getStart_time() {
		return start_time;
	}

	public void setStart_time(int start_time) {
		this.start_time = start_time;
	}

	public int getEnd_time() {
		return end_time;
	}

	public void setEnd_time(int end_time) {
		this.end_time = end_time;
	}

	public int getBrk_start_time() {
		return brk_start_time;
	}

	public void setBrk_start_time(int brk_start_time) {
		this.brk_start_time = brk_start_time;
	}

	public int getBrk_end_time() {
		return brk_end_time;
	}

	public void setBrk_end_time(int brk_end_time) {
		this.brk_end_time = brk_end_time;
	}

	public int getSession_dur() {
		return session_dur;
	}

	public void setSession_dur(int session_dur) {
		this.session_dur = session_dur;
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

	public int getStart_time_hr() {
		return start_time_hr;
	}

	public void setStart_time_hr(int start_time_hr) {
		this.start_time_hr = start_time_hr;
	}

	public int getStart_time_min() {
		return start_time_min;
	}

	public void setStart_time_min(int start_time_min) {
		this.start_time_min = start_time_min;
	}

	public int getEnd_time_hr() {
		return end_time_hr;
	}

	public void setEnd_time_hr(int end_time_hr) {
		this.end_time_hr = end_time_hr;
	}

	public int getEnd_time_min() {
		return end_time_min;
	}

	public void setEnd_time_min(int end_time_min) {
		this.end_time_min = end_time_min;
	}

	public int getBrk_start_time_hr() {
		return brk_start_time_hr;
	}

	public void setBrk_start_time_hr(int brk_start_time_hr) {
		this.brk_start_time_hr = brk_start_time_hr;
	}

	public int getBrk_start_time_min() {
		return brk_start_time_min;
	}

	public void setBrk_start_time_min(int brk_start_time_min) {
		this.brk_start_time_min = brk_start_time_min;
	}

	public int getBrk_dur_min() {
		return brk_dur_min;
	}

	public void setBrk_dur_min(int brk_dur_min) {
		this.brk_dur_min = brk_dur_min;
	}

	public String getDay_nm() {
		return day_nm;
	}

	public void setDay_nm(String day_nm) {
		this.day_nm = day_nm;
	}

	public int getClass_id() {
		return class_id;
	}

	public void setClass_id(int class_id) {
		this.class_id = class_id;
	}

	public int getStaff_id() {
		return staff_id;
	}

	public void setStaff_id(int staff_id) {
		this.staff_id = staff_id;
	}

	public ArrayList<ClassSubjectDayTiming> getTtable() {
		if(ttable == null)
			ttable = new ArrayList<ClassSubjectDayTiming>();
		return ttable;
	}
	
}