package com.dexter.bradawl.dto;

import java.util.ArrayList;

import com.dexter.bradawl.model.StudentModel;

public class NewSSS
{
	private int class_id;
	private int class_id2;
	
	private ArrayList<Attendance> students; // to hold the students
	
	public NewSSS()
	{}

	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int class_id)
	{
		this.class_id = class_id;
	}

	public int getClass_id2()
	{
		return class_id2;
	}

	public void setClass_id2(int class_id2)
	{
		this.class_id2 = class_id2;
	}

	public ArrayList<Attendance> getStudents()
	{
		if(students == null)
		{
			if(getClass_id() > 0)
			{
				// now get students in the class
				students = new StudentModel().GetClassStudents(getClass_id(), -1);
			}
			else
			{
				students = new ArrayList<Attendance>();
			}
		}
			
		return students;
	}

	public void setStudents(ArrayList<Attendance> students)
	{
		this.students = students;
	}
	
}
