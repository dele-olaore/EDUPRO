package com.dexter.bradawl.mbean;

import java.util.ArrayList;

import javax.faces.context.FacesContext;
import javax.faces.model.SelectItem;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.AutoCreate;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;

import com.dexter.bradawl.dto.Attendance;
import com.dexter.bradawl.dto.ClassFee;
import com.dexter.bradawl.dto.ClassSubject;
import com.dexter.bradawl.dto.Fee;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Session;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.Term;
import com.dexter.bradawl.model.BursaryModel;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.SessionModel;
import com.dexter.bradawl.model.StaffModel;
import com.dexter.bradawl.model.StudentModel;
import com.dexter.bradawl.util.AppOptions;
import com.sun.faces.context.FacesContextImpl;

@Name("dropdownBean")
@Scope(ScopeType.SESSION)
@AutoCreate
public class DropDownBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@In
	AppOptions appOptions;
	
	private int class_id = -1;
	
	private SelectItem[] feeCategories;
	private SelectItem[] staffCategories;
	private SelectItem[] departments;
	
	private int staff_cat_id = -1;
	private int department_id = -1;
	private SelectItem[] staffsByCatDept;
	
	private String[] clevels_str = new String[] {"Primary", "JSS", "SSS"};
	private SelectItem[] clevels;
	
	private String[] levelnos_str = new String[] {"1", "2", "3", "4", "5", "6"};
	private SelectItem[] levelnos;
	
	private String[] cgroups_str = new String[] {"A", "B", "C", "D", "E", "F", "G", "H", "I", "J"};
	private SelectItem[] cgroups;
	
	private SelectItem[] roles;
	
	private SelectItem[] blocks;
	private SelectItem[] houses;
	private SelectItem[] hostels;
	private SelectItem[] classes;
	private SelectItem[] classSubjects;
	
	private SelectItem[] titles;
	private SelectItem[] relationships;
	
	private SelectItem[] medicaltests;
	private SelectItem[] medicalresults;
	private SelectItem[] clubs;
	
	private SelectItem[] fees;

	public SelectItem[] getSessions()
	{
		SelectItem[] list = null;
		
		ArrayList<Session> sessions = new SessionModel().getAllSession();
		if(sessions.size() > 0)
		{
			list = new SelectItem[sessions.size()];
			
			int i=0;
			for(Session e : sessions)
			{
				list[i] = new SelectItem(""+e.getSession_id(), e.getSession_nm());
				i++;
			}
		}
		else
		{
			list = new SelectItem[0];
			//list[0] = new SelectItem("0", "No item found!");
		}
		
		return list;
	}
	
	public SelectItem[] getSessionTerms()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		int session_id = ((BursaryBean)curContext.getExternalContext().getSessionMap().get("bursaryBean")).getSearch().getSession_id();
		
		SelectItem[] list = null;
		
		if(session_id == 0)
			session_id = -1;
		
		ArrayList<Term> terms = new SessionModel().GetSessionTerms(session_id);
		if(terms.size() > 0)
		{
			list = new SelectItem[terms.size()];
			
			int i=0;
			for(Term e : terms)
			{
				list[i] = new SelectItem(""+e.getTerm_id(), e.getTerm_nm());
				i++;
			}
		}
		else
		{
			list = new SelectItem[0];
			//list[0] = new SelectItem("0", "No item found!");
		}
		
		return list;
	}
	
	public SelectItem[] getSortedClasses()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		SelectItem[] classes = null;
		
		String class_lvl = ((BursaryBean)curContext.getExternalContext().getSessionMap().get("bursaryBean")).getSearch().getClass_lvl();
		int lvl_no = ((BursaryBean)curContext.getExternalContext().getSessionMap().get("bursaryBean")).getSearch().getLvl_no();
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
		
		if(list.size() > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> list2 = new ArrayList<com.dexter.bradawl.dto.Class>();
			
			for(com.dexter.bradawl.dto.Class e : list)
			{
				boolean class_lvl_bool = true;
				if(class_lvl != null && class_lvl.trim().length() > 0)
				{
					class_lvl_bool = e.getClass_level().equalsIgnoreCase(class_lvl);
				}
				
				boolean lvl_no_bool = true;
				if(lvl_no > 0)
				{
					lvl_no_bool = e.getLevel_num() == lvl_no;
				}
				
				if(class_lvl_bool && lvl_no_bool)
				{
					list2.add(e);
				}
			}
			
			if(list2.size() > 0)
			{
				classes = new SelectItem[list2.size()];
				
				for(int i=0; i<list2.size(); i++)
				{
					com.dexter.bradawl.dto.Class c = list2.get(i);
					
					classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
				}
			}
			else
			{
				classes = new SelectItem[0];
			}
		}
		else
		{
			classes = new SelectItem[0];
			// classes[0] = new SelectItem("0", "No item found!");
		}
		
		return classes;
	}
	
	public SelectItem[] getClassFeeCategories()
	{
		SelectItem[] feeCategories = null;
		
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		int class_id = ((BursaryBean)curContext.getExternalContext().getSessionMap().get("bursaryBean")).getSearch().getClass_id();
		
		ArrayList<ClassFee> cfl = new ArrayList<ClassFee>();
		if(class_id > 0)
		{
			cfl = new BursaryModel().GetClassFeeMapping(class_id);
		}
		
		ArrayList<Ref> list = new RefModel().getRefObjects(5);
		if(list.size() > 0)
		{
			if(class_id > 0)
			{
				if(cfl.size() > 0)
				{
					ArrayList<Ref> list2 = new ArrayList<Ref>();
					for(Ref e : list)
					{
						for(ClassFee e2 : cfl)
						{
							if(e.getId() == e2.getFee_cat_id())
							{
								list2.add(e);
								break;
							}
						}
					}
					
					feeCategories = new SelectItem[list2.size()];
					
					for(int i=0; i<list2.size(); i++)
					{
						Ref e = list2.get(i);
						
						feeCategories[i] = new SelectItem(""+e.getId(), e.getName());
					}
				}
				else
				{
					feeCategories = new SelectItem[0];
				}
			}
			else
			{
				feeCategories = new SelectItem[list.size()];
				
				for(int i=0; i<list.size(); i++)
				{
					Ref e = list.get(i);
					
					feeCategories[i] = new SelectItem(""+e.getId(), e.getName());
				}
			}
		}
		else
		{
			feeCategories = new SelectItem[0];
			// feeCategories[0] = new SelectItem("0", "No item found!");
		}
		
		return feeCategories;
	}
	
	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int class_id)
	{
		this.class_id = class_id;
	}

	public ArrayList<Student> getStudents()
	{
		Student st = new Student();
		st.setClass_id(getClass_id());
		ArrayList<Student> list = new StudentModel().getStudentsBySearch(st);
		
		return list;
	}
	
	public SelectItem[] getFeeCategories()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(5);
		if(list.size() > 0)
		{
			feeCategories = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				
				feeCategories[i] = new SelectItem(""+e.getId(), e.getName());
			}
		}
		else
		{
			feeCategories = new SelectItem[1];
			feeCategories[0] = new SelectItem("0", "No item found!");
		}
		
		return feeCategories;
	}
	
	public SelectItem[] getFees(int fee_cat_id)
	{
		ArrayList<Fee> list = new BursaryModel().GetFeeByCat(fee_cat_id);
		if(list.size() > 0)
		{
			fees = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Fee e = list.get(i);
				
				fees[i] = new SelectItem(""+e.getFee_id(), e.getFee_nm());
			}
		}
		else
		{
			fees = new SelectItem[1];
			fees[0] = new SelectItem("0", "No item found!");
		}
		
		return fees;
	}

	public SelectItem[] getStaffCategories()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(2);
		if(list.size() > 0)
		{
			staffCategories = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				
				staffCategories[i] = new SelectItem(""+e.getId(), e.getName());
			}
		}
		else
		{
			staffCategories = new SelectItem[1];
			staffCategories[0] = new SelectItem("0", "No item found!");
		}
		
		return staffCategories;
	}

	public SelectItem[] getDepartments()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(1);
		if(list.size() > 0)
		{
			departments = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				
				departments[i] = new SelectItem(""+e.getId(), e.getName());
			}
		}
		else
		{
			departments = new SelectItem[1];
			departments[0] = new SelectItem("0", "No item found!");
		}
		
		return departments;
	}

	public int getStaff_cat_id()
	{
		return staff_cat_id;
	}

	public void setStaff_cat_id(int staff_cat_id)
	{
		this.staff_cat_id = staff_cat_id;
	}

	public int getDepartment_id()
	{
		return department_id;
	}

	public void setDepartment_id(int department_id)
	{
		this.department_id = department_id;
	}

	public SelectItem[] getStaffsByCatDept()
	{
		ArrayList<Staff> list = new StaffModel().getStaffs(getStaff_cat_id(), getDepartment_id(), 1); // default status to 1 - Active
		if(list.size() > 0)
		{
			staffsByCatDept = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Staff e = list.get(i);
				
				staffsByCatDept[i] = new SelectItem(""+e.getStaff_id(), e.getStaff_fn() + " " + e.getStaff_mn() + " " + e.getStaff_ln());
			}
		}
		else
		{
			staffsByCatDept = new SelectItem[1];
			staffsByCatDept[0] = new SelectItem("0", "No item found!");
		}
		
		return staffsByCatDept;
	}
	
	public ArrayList<Staff> getStaffs()
	{
		ArrayList<Staff> list = new StaffModel().getStaffs(getStaff_cat_id(), getDepartment_id(), 1);
		
		return list;
	}

	public SelectItem[] getClevels()
	{
		clevels = new SelectItem[clevels_str.length];
		
		for(int i=0; i<clevels_str.length; i++)
		{
			clevels[i] = new SelectItem(clevels_str[i], clevels_str[i]);
		}
		
		return clevels;
	}

	public SelectItem[] getLevelnos()
	{
		levelnos = new SelectItem[levelnos_str.length];
		
		for(int i=0; i<levelnos_str.length; i++)
		{
			levelnos[i] = new SelectItem(levelnos_str[i], levelnos_str[i]);
		}
		
		return levelnos;
	}

	public SelectItem[] getCgroups()
	{
		cgroups = new SelectItem[cgroups_str.length];
		
		for(int i=0; i<cgroups_str.length; i++)
		{
			cgroups[i] = new SelectItem(cgroups_str[i], cgroups_str[i]);
		}
		
		return cgroups;
	}

	public SelectItem[] getRoles()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(3); // gets user roles
		if(list.size() > 0)
		{
			roles = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				
				roles[i] = new SelectItem(""+e.getId(), e.getName());
			}
		}
		else
		{
			roles = new SelectItem[1];
			roles[0] = new SelectItem("0", "No item found!");
		}
		
		return roles;
	}

	public SelectItem[] getBlocks()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(10); // gets blocks
		if(list.size() > 0)
		{
			blocks = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				
				blocks[i] = new SelectItem(""+e.getId(), e.getName());
			}
		}
		else
		{
			blocks = new SelectItem[1];
			blocks[0] = new SelectItem("0", "No item found!");
		}
		
		return blocks;
	}

	public SelectItem[] getHouses()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(12); // gets houses
		if(list.size() > 0)
		{
			houses = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				
				houses[i] = new SelectItem(""+e.getId(), e.getName());
			}
		}
		else
		{
			houses = new SelectItem[0];
			// houses[0] = new SelectItem("0", "No item found!");
		}
		
		return houses;
	}

	public SelectItem[] getMyclasses()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		SelectItem[] classes = null;
		
		int staff_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getStaff_id();
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getStaffClasses(staff_id);
		
		if(list.size() > 0)
		{
			classes = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				com.dexter.bradawl.dto.Class c = list.get(i);
				
				classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
			}
		}
		else
		{
			classes = new SelectItem[1];
			classes[0] = new SelectItem("0", "No item found!");
		}
		
		return classes;
	}
	
	public SelectItem[] getMysubjects()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		SelectItem[] subjects = null;
		
		int staff_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getStaff_id();
		
		ArrayList<Ref> list = new StaffModel().GetStaffSubjects(staff_id);
		
		if(list.size() > 0)
		{
			subjects = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Ref c = list.get(i);
				
				subjects[i] = new SelectItem(c.getId(), c.getName());
			}
		}
		else
		{
			subjects = new SelectItem[1];
			subjects[0] = new SelectItem("0", "No item found!");
		}
		
		return subjects;
	}
	
	public SelectItem[] getClasses()
	{
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
		
		if(list.size() > 0)
		{
			classes = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				com.dexter.bradawl.dto.Class c = list.get(i);
				
				classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
			}
		}
		else
		{
			classes = new SelectItem[1];
			classes[0] = new SelectItem("0", "No item found!");
		}
		
		return classes;
	}
	
	public SelectItem[] getClassStudents(int class_id, int session_id)
	{
		SelectItem[] list = new SelectItem[0];
		
		ArrayList<Attendance> l = new StudentModel().GetClassStudents(class_id, session_id);
		list = new SelectItem[l.size()];
		
		for(int i=0; i<list.length; i++)
		{
			Attendance e = l.get(i);
			list[i] = new SelectItem(e.getStudent_id(), e.getStudent_fn() + " " + e.getStudent_mn() + " " + e.getStudent_ln());
		}
		
		return list;
	}
	
	public SelectItem[] getPrimary6Classes()
	{
		SelectItem[] primary6Classes = null;
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
		
		if(list.size() > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> myList = new ArrayList<com.dexter.bradawl.dto.Class>();
			
			for(com.dexter.bradawl.dto.Class e : list)
			{
				if(e.getClass_level().equalsIgnoreCase("primary") && e.getLevel_num() == 6) // primary 6
				{
					myList.add(e);
				}
			}
			
			if(myList.size() > 0)
			{
				primary6Classes = new SelectItem[myList.size()];
				for(int i=0; i<myList.size(); i++)
				{
					com.dexter.bradawl.dto.Class c = myList.get(i);
					primary6Classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
				}
			}
		}
		
		return primary6Classes;
	}
	
	public SelectItem[] getJss3Classes()
	{
		SelectItem[] jss3Classes = null;
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
		
		if(list.size() > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> myList = new ArrayList<com.dexter.bradawl.dto.Class>();
			
			for(com.dexter.bradawl.dto.Class e : list)
			{
				if(e.getClass_level().equalsIgnoreCase("jss") && e.getLevel_num() == 3) // jss 3
				{
					myList.add(e);
				}
			}
			
			if(myList.size() > 0)
			{
				jss3Classes = new SelectItem[myList.size()];
				for(int i=0; i<myList.size(); i++)
				{
					com.dexter.bradawl.dto.Class c = myList.get(i);
					jss3Classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
				}
			}
		}
		
		return jss3Classes;
	}
	
	public SelectItem[] getJss1Classes()
	{
		SelectItem[] jss1Classes = null;
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
		
		if(list.size() > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> myList = new ArrayList<com.dexter.bradawl.dto.Class>();
			
			for(com.dexter.bradawl.dto.Class e : list)
			{
				if(e.getClass_level().equalsIgnoreCase("jss") && e.getLevel_num() == 1) // jss 1
				{
					myList.add(e);
				}
			}
			
			if(myList.size() > 0)
			{
				jss1Classes = new SelectItem[myList.size()];
				for(int i=0; i<myList.size(); i++)
				{
					com.dexter.bradawl.dto.Class c = myList.get(i);
					jss1Classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
				}
			}
		}
		
		return jss1Classes;
	}
	
	public SelectItem[] getSss1Classes()
	{
		SelectItem[] sss1Classes = null;
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
		
		if(list.size() > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> myList = new ArrayList<com.dexter.bradawl.dto.Class>();
			
			for(com.dexter.bradawl.dto.Class e : list)
			{
				if(e.getClass_level().equalsIgnoreCase("sss") && e.getLevel_num() == 1) // jss 3
				{
					myList.add(e);
				}
			}
			
			if(myList.size() > 0)
			{
				sss1Classes = new SelectItem[myList.size()];
				for(int i=0; i<myList.size(); i++)
				{
					com.dexter.bradawl.dto.Class c = myList.get(i);
					sss1Classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
				}
			}
		}
		
		return sss1Classes;
	}
	
	public SelectItem[] getSubjectClasses(int sub_id)
	{
		SelectItem[] classes = null;
		
		ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().GetSubjectClasses(sub_id);
		
		if(list.size() > 0)
		{
			classes = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				com.dexter.bradawl.dto.Class c = list.get(i);
				
				classes[i] = new SelectItem(c.getClass_id(), c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
			}
		}
		else
		{
			classes = new SelectItem[1];
			classes[0] = new SelectItem("0", "No item found!");
		}
		
		return classes;
	}

	public SelectItem[] getClassSubjects(int class_id)
	{
		ArrayList<ClassSubject> list = new RefModel().GetClassSubjects(class_id);
		
		if(list.size() > 0)
		{
			classSubjects = new SelectItem[list.size()+1];
			classSubjects[0] = new SelectItem("0", "");
			
			for(int i=0; i<list.size(); i++)
			{
				ClassSubject cs = list.get(i);
				
				classSubjects[i+1] = new SelectItem(cs.getSub_id(), cs.getSub_nm());
			}
		}
		else
		{
			classSubjects = new SelectItem[1];
			classSubjects[0] = new SelectItem("0", "No item found!");
		}
		
		return classSubjects;
	}
	
	public SelectItem[] getGuardianStudentSubjects(int student_id)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		ArrayList<Student> students = ((StudentBean)curContext.getExternalContext().getSessionMap().get("studentBean")).getGuardianStudents();
		
		int class_id = 0;
		
		for(Student e : students)
		{
			if(e.getStudent_id() == student_id)
			{
				class_id = e.getCurClass_id();
				break;
			}
		}
		
		return getClassSubjects(class_id);
	}
	
	public SelectItem[] getStudentSessionSubjects(int student_id, int session_id)
	{
		int class_id = 0;
		
		Ref e = new StudentModel().GetStudentSessionClass(student_id, session_id);
		if(e != null)
			class_id = e.getId();
		
		return getClassSubjects(class_id);
	}
	
	public SelectItem[] getSubjectStaffs(int sub_id)
	{
		SelectItem[] subjectStaffs = null;
		
		ArrayList<Staff> list = new StaffModel().GetSubjectStaffs(sub_id);
		
		if(list.size() > 0)
		{
			subjectStaffs = new SelectItem[list.size()];
			
			for(int i=0; i<list.size(); i++)
			{
				Staff s = list.get(i);
				
				subjectStaffs[i] = new SelectItem(s.getStaff_id(), s.getStaff_fn() + " " + s.getStaff_mn() + " " + s.getStaff_ln());
			}
		}
		else
		{
			subjectStaffs = new SelectItem[1];
			subjectStaffs[0] = new SelectItem("0", "No item found!");
		}
		
		return subjectStaffs;
	}

	public SelectItem[] getHostels(int house_id, String type)
	{
		if(type == null || type.trim().length() == 0)
		{
			if(appOptions.getSchool().getOp_type_id() == 2)
			{
				type = "b";
			}
			else if(appOptions.getSchool().getOp_type_id() == 3)
			{
				type = "d";
			}
		}
		
		if(type.equalsIgnoreCase("b"))
		{
			ArrayList<Ref> list = new RefModel().getHostelsByHouse(house_id);
			if(list.size() > 0)
			{
				hostels = new SelectItem[list.size()];
				for(int i=0; i<list.size(); i++)
				{
					Ref e = list.get(i);
					hostels[i] = new SelectItem(e.getId(), e.getName() + "(Block: " + e.getName3() + ")");
				}
			}
			else
			{
				hostels = new SelectItem[1];
				hostels[0] = new SelectItem("0", "No item found!");
			}
		}
		else
		{
			hostels = new SelectItem[1];
			hostels[0] = new SelectItem("0", "No hostel needed for day students!");
		}
		
		return hostels;
	}

	public SelectItem[] getTitles()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(6);
		if(list.size() > 0)
		{
			titles = new SelectItem[list.size()];
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				titles[i] = new SelectItem(e.getId(), e.getName());
			}
		}
		else
		{
			titles = new SelectItem[1];
			titles[0] = new SelectItem("0", "No item found!");
		}
		
		return titles;
	}

	public SelectItem[] getRelationships()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(7);
		if(list.size() > 0)
		{
			relationships = new SelectItem[list.size()];
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				relationships[i] = new SelectItem(e.getId(), e.getName());
			}
		}
		else
		{
			relationships = new SelectItem[1];
			relationships[0] = new SelectItem("0", "No item found!");
		}
		
		return relationships;
	}

	public SelectItem[] getMedicaltests()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(8);
		if(list.size() > 0)
		{
			medicaltests = new SelectItem[list.size()];
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				medicaltests[i] = new SelectItem(e.getId(), e.getName());
			}
		}
		else
		{
			medicaltests = new SelectItem[1];
			medicaltests[0] = new SelectItem("0", "No item found!");
		}
		
		return medicaltests;
	}

	public SelectItem[] getMedicalresults()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(9);
		if(list.size() > 0)
		{
			medicalresults = new SelectItem[list.size()];
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				medicalresults[i] = new SelectItem(e.getId(), e.getName());
			}
		}
		else
		{
			medicalresults = new SelectItem[1];
			medicalresults[0] = new SelectItem("0", "No item found!");
		}
		
		return medicalresults;
	}

	public SelectItem[] getClubs()
	{
		ArrayList<Ref> list = new RefModel().getRefObjects(11);
		if(list.size() > 0)
		{
			clubs = new SelectItem[list.size()];
			for(int i=0; i<list.size(); i++)
			{
				Ref e = list.get(i);
				clubs[i] = new SelectItem(e.getId(), e.getName());
			}
		}
		else
		{
			clubs = new SelectItem[1];
			clubs[0] = new SelectItem("0", "No item found!");
		}
		
		return clubs;
	}
	
	public SelectItem[] getDays()
	{
		SelectItem[] days = new SelectItem[]{new SelectItem(1, "Monday"), new SelectItem(2, "Tuesday"), new SelectItem(3, "Wednesday"), new SelectItem(4, "Thursday"), new SelectItem(5, "Friday"), new SelectItem(6, "Saturday"), new SelectItem(7, "Sunday")};
		
		return days;
	}
}
