package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.TimetableModel;

public class ClassSubjectDayTiming
{
	private int id;
	private int class_id;
	private int subject_id;
	private int day;
	private int start_time_in_minutes;
	private int user_id;
	private Date crt_dt;
	
	private int start_time_hr, start_time_min;
	private boolean brk = false;
	
	private String sub_nm;
	private String sub_desc;
	
	private int staff_id;
	private String class_nm;
	
	public ClassSubjectDayTiming()
	{}

	public void loadSubject()
	{
		if(getClass_id() > 0 && getDay() > 0 && !brk && getStart_time_in_minutes() > 0)
		{
			// TODO: Load the subject for this class in this day at the time
			ClassSubjectDayTiming e = new TimetableModel().getClassDayTimeSub(getClass_id(), getDay(), getStart_time_in_minutes());
			if(e != null)
			{
				setSubject_id(e.getSubject_id());
				setSub_nm(e.getSub_nm());
				setSub_desc(e.getSub_desc());
			}
		}
	}
	
	public void loadStaffSubject()
	{
		if(getStaff_id() > 0 && getDay() > 0 && !brk && getStart_time_in_minutes() > 0)
		{
			// TODO: Load the subject for this class in this day at the time
			ClassSubjectDayTiming e = new TimetableModel().getStaffDayTimeSub(getStaff_id(), getDay(), getStart_time_in_minutes());
			if(e != null)
			{
				setClass_id(e.getClass_id());
				ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
				for(com.dexter.bradawl.dto.Class c : list)
				{
					if(c.getClass_id() == getClass_id())
					{
						setClass_nm(c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
						break;
					}
				}
				setSubject_id(e.getSubject_id());
				setSub_nm(e.getSub_nm());
				setSub_desc(e.getSub_desc());
			}
		}
	}
	
	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getClass_id() {
		return class_id;
	}

	public void setClass_id(int class_id) {
		this.class_id = class_id;
	}

	public int getSubject_id() {
		return subject_id;
	}

	public void setSubject_id(int subject_id) {
		this.subject_id = subject_id;
	}

	public int getDay() {
		return day;
	}

	public void setDay(int day) {
		this.day = day;
	}

	public int getStart_time_in_minutes() {
		return start_time_in_minutes;
	}

	public void setStart_time_in_minutes(int start_time_in_minutes) {
		if(start_time_in_minutes > 0)
		{
			setStart_time_hr(start_time_in_minutes/60);
			setStart_time_min(start_time_in_minutes%60);
		}
		this.start_time_in_minutes = start_time_in_minutes;
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

	public boolean getBrk() {
		return brk;
	}

	public void setBrk(boolean brk) {
		this.brk = brk;
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

	public int getStaff_id() {
		return staff_id;
	}

	public void setStaff_id(int staff_id) {
		this.staff_id = staff_id;
	}

	public String getClass_nm() {
		return class_nm;
	}

	public void setClass_nm(String class_nm) {
		this.class_nm = class_nm;
	}
	
}
