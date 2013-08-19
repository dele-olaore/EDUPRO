package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.RefModel;

public class Student implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int student_id;
	private String student_fn;
	private String student_mn;
	private String student_ln;
	private int addr_id;
	private String gender;
	private Date dob;
	private int house_id;
	private String house_nm;
	private int class_id;
	private String class_nm;
	private String disability;
	private String precaution;
	private String blood_grp;
	private String genotype;
	private Date date_enrolled;
	private String student_year_enroll;
	
	private int user_id;
	private Date crt_dt;
	private int student_status_id;
	private int year_graduated;
	private int rollNumber;
	private boolean hasRoll;
	
	private String student_type;
	private int hostel_id;
	
	private int curClass_id;
	
	private Address address;
	
	private ArrayList<Ref> clubs;
	private ArrayList<Guardian> guardians;
	private ArrayList<StudentMedical> medicals;
	
	private User user;
	
	public Student()
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

	public int getStudent_id()
	{
		return student_id;
	}

	public void setStudent_id(int studentId)
	{
		student_id = studentId;
	}

	public String getStudent_fn()
	{
		return student_fn;
	}

	public void setStudent_fn(String studentFn)
	{
		student_fn = studentFn;
	}

	public String getStudent_mn()
	{
		return student_mn;
	}

	public void setStudent_mn(String studentMn)
	{
		student_mn = studentMn;
	}

	public String getStudent_ln()
	{
		return student_ln;
	}

	public void setStudent_ln(String studentLn)
	{
		student_ln = studentLn;
	}

	public int getAddr_id()
	{
		return addr_id;
	}

	public void setAddr_id(int addrId)
	{
		addr_id = addrId;
	}

	public String getGender()
	{
		return gender;
	}

	public void setGender(String gender)
	{
		this.gender = gender;
	}

	public Date getDob()
	{
		return dob;
	}

	public void setDob(Date dob)
	{
		this.dob = dob;
	}

	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int classId)
	{
		class_id = classId;
	}

	public String getClass_nm()
	{
		return class_nm;
	}

	public void setClass_nm(String class_nm)
	{
		this.class_nm = class_nm;
	}

	public String getDisability()
	{
		return disability;
	}

	public void setDisability(String disability)
	{
		this.disability = disability;
	}

	public String getPrecaution()
	{
		return precaution;
	}

	public void setPrecaution(String precaution)
	{
		this.precaution = precaution;
	}

	public String getBlood_grp()
	{
		return blood_grp;
	}

	public void setBlood_grp(String bloodGrp)
	{
		blood_grp = bloodGrp;
	}

	public String getGenotype()
	{
		return genotype;
	}

	public void setGenotype(String genotype)
	{
		this.genotype = genotype;
	}

	public Date getDate_enrolled()
	{
		return date_enrolled;
	}

	public void setDate_enrolled(Date dateEnrolled)
	{
		date_enrolled = dateEnrolled;
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

	public int getStudent_status_id()
	{
		return student_status_id;
	}

	public void setStudent_status_id(int studentStatusId)
	{
		student_status_id = studentStatusId;
	}

	public int getYear_graduated()
	{
		return year_graduated;
	}

	public void setYear_graduated(int yearGraduated)
	{
		year_graduated = yearGraduated;
	}

	public int getRollNumber()
	{
		return rollNumber;
	}

	public void setRollNumber(int rollNumber)
	{
		this.rollNumber = rollNumber;
	}

	public int getCurClass_id()
	{
		return curClass_id;
	}

	public void setCurClass_id(int curClassId)
	{
		if(curClassId > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
			for(com.dexter.bradawl.dto.Class c : list)
			{
				if(c.getClass_id() == curClassId)
				{
					setClass_nm(c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
					break;
				}
			}
		}
		curClass_id = curClassId;
	}

	public int getHouse_id()
	{
		return house_id;
	}

	public void setHouse_id(int house_id)
	{
		if(house_id > 0)
		{
			ArrayList<Ref> list = new RefModel().getRefObjects(12);
			for(Ref e : list)
			{
				if(e.getId() == house_id)
				{
					setHouse_nm(e.getName());
					break;
				}
			}
		}
		this.house_id = house_id;
	}

	public String getHouse_nm()
	{
		return house_nm;
	}

	public void setHouse_nm(String house_nm)
	{
		this.house_nm = house_nm;
	}

	public String getStudent_type()
	{
		return student_type;
	}

	public void setStudent_type(String student_type)
	{
		this.student_type = student_type;
	}

	public int getHostel_id()
	{
		return hostel_id;
	}

	public void setHostel_id(int hostel_id)
	{
		this.hostel_id = hostel_id;
	}

	public ArrayList<Ref> getClubs()
	{
		if(clubs == null)
			clubs = new ArrayList<Ref>();
		return clubs;
	}

	public void setClubs(ArrayList<Ref> clubs)
	{
		this.clubs = clubs;
	}

	public ArrayList<Guardian> getGuardians()
	{
		if(guardians == null)
			guardians = new ArrayList<Guardian>();
		return guardians;
	}

	public void setGuardians(ArrayList<Guardian> guardians)
	{
		this.guardians = guardians;
	}

	public ArrayList<StudentMedical> getMedicals()
	{
		if(medicals == null)
			medicals = new ArrayList<StudentMedical>();
		return medicals;
	}

	public void setMedicals(ArrayList<StudentMedical> medicals)
	{
		this.medicals = medicals;
	}

	public String getStudent_year_enroll()
	{
		return student_year_enroll;
	}

	public void setStudent_year_enroll(String student_year_enroll)
	{
		this.student_year_enroll = student_year_enroll;
	}

	public User getUser() {
		if(user == null)
			user = new User();
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	public boolean getHasRoll() {
		return hasRoll;
	}

	public void setHasRoll(boolean hasRoll) {
		if(hasRoll)
			this.rollNumber = 0;
		this.hasRoll = hasRoll;
	}
	
}