package com.dexter.bradawl.mbean;

import java.util.ArrayList;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.log.Log;
import org.richfaces.event.DropEvent;

import com.dexter.bradawl.dto.ClassSubject;
import com.dexter.bradawl.dto.ClassSubjectDayTiming;
import com.dexter.bradawl.dto.DayTiming;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.TimetableModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("timetableBean")
@Scope(ScopeType.SESSION)
public class TimetableBean implements java.io.Serializable
{
private static final long serialVersionUID = 1L;
	
	@Logger
	private Log log;
	
	@In
	private AppOptions appOptions;
	
	private int class_id;
	private String class_nm;
	private ArrayList<ClassSubject> classSubjects;
	private ArrayList<DayTiming> days, days2;
	private ClassSubjectDayTiming csdt;
	// private Hashtable<Integer, ArrayList<ClassSubjectDayTiming>> classTimings;
	// private ArrayList<ArrayList<ClassSubjectDayTiming>>;
	
	public void LoadStaffTimetable()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Loading staff timetable...");
		
		AuthenticatorBean authB = (AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator");
		
		if(authB != null)
		{
			if(authB.getStaff() != null)
			{
				int staff_id = authB.getStaff().getStaff_id();
				if(staff_id > 0)
				{
					TimetableModel ttModel = new TimetableModel();
					
					setDays2(ttModel.getTimings());
					for(DayTiming day : getDays2())
					{
						day.setStaff_id(staff_id);
						day.LoadHeaders();
					}
				}
			}
			else if(authB.getStudent() != null)
			{
				int class_id = authB.getStudent().getCurClass_id();
				if(class_id > 0)
				{
					TimetableModel ttModel = new TimetableModel();
					
					setDays2(ttModel.getTimings());
					for(DayTiming day : getDays2())
					{
						day.setClass_id(class_id);
						day.LoadHeaders();
					}
				}
			}
		}
	}
	
	public void LoadClassTimetable()
	{
		if(getClass_id() > 0)
		{
			TimetableModel ttModel = new TimetableModel();
			
			setDays(ttModel.getTimings());
			for(DayTiming day : getDays())
			{
				day.setClass_id(getClass_id());
				day.LoadHeaders();
			}
		}
	}
	
	public void processDrop(DropEvent event)
	{
		if(event.getDragType().equals("CLASS_SUBJECT"))
		{
			Object dragObj = event.getDragValue();
			if(dragObj != null && dragObj instanceof ClassSubject)
			{
				Object dropObj = event.getDropValue();
				if(dropObj != null && dropObj instanceof ClassSubjectDayTiming)
				{
					FacesContext curContext = FacesContextImpl.getCurrentInstance();
					log.info("Assigning subject to class in day at time...");
					
					ClassSubject drag = (ClassSubject)dragObj;
					ClassSubjectDayTiming drop = (ClassSubjectDayTiming)dropObj;
					int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
					System.out.println("valid drag n drop");
					// After sending to db is successful
					int ret = new TimetableModel().setClassDayTimeSub(getClass_id(), drop.getDay(), drag.getSub_id(), drop.getStart_time_in_minutes(), user_id);
					switch(ret)
					{
						case 0:
						{
							log.info("Subject mapped successfully");
							drop.loadSubject();
							curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
							break;
						}
						case 2:
						{
							curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.duplicate", null), null));
							break;
						}
						default:
						{
							curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.failed", null), null));
							break;
						}
					}
				}
				else
				{
					System.out.println("Invalid drop");
				}
			}
			else
			{
				System.out.println("Invalid drag");
			}
		}
	}

	public void RemoveClassSubTimeMap()
	{
		if(getCsdt() != null && getCsdt().getClass_id() > 0 && getCsdt().getDay() > 0 && getCsdt().getStart_time_in_minutes() > 0 && getCsdt().getSubject_id() > 0)
		{
			// Now remove the timing
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Removing subject from class in day timetable...");
			
			int ret = new TimetableModel().removeClassDayTimeSub(getClass_id(), getCsdt().getDay(), getCsdt().getSubject_id(), getCsdt().getStart_time_in_minutes());
			switch(ret)
			{
				case 0:
				{
					log.info("Subject removed successfully");
					for(DayTiming day : getDays())
					{
						if(day.getDay() == getCsdt().getDay())
						{
							day.LoadHeaders();
							System.out.println("loaded");
							break;
						}
					}
					setCsdt(null);
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("remove.success", null), null));
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.notfound", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("remove.failed", null), null));
					break;
				}
			}
		}
	}
	
	public int getClass_id() {
		return class_id;
	}

	public void setClass_id(int class_id) {
		if(class_id > 0)
		{
			ArrayList<com.dexter.bradawl.dto.Class> list = new RefModel().getClasses();
			for(com.dexter.bradawl.dto.Class c : list)
			{
				if(c.getClass_id() == class_id)
				{
					setClass_nm(c.getClass_level() + " " + c.getLevel_num() + " (" + c.getClass_group() + ")");
					break;
				}
			}
		}
		this.class_id = class_id;
	}

	public String getClass_nm() {
		return class_nm;
	}

	public void setClass_nm(String class_nm) {
		this.class_nm = class_nm;
	}

	public ArrayList<ClassSubject> getClassSubjects() {
		if(class_id > 0)
		{
			classSubjects = new RefModel().GetClassSubjects(class_id);
		}
		else
			classSubjects = new ArrayList<ClassSubject>();
		return classSubjects;
	}

	public void setClassSubjects(ArrayList<ClassSubject> classSubjects) {
		this.classSubjects = classSubjects;
	}

	/*public Hashtable<Integer, ArrayList<ClassSubjectDayTiming>> getClassTimings() {
		if(classTimings == null)
			classTimings = new Hashtable<Integer, ArrayList<ClassSubjectDayTiming>>();
		return classTimings;
	}
	
	public ArrayList<ClassSubjectDayTiming> getClassTimings(int day) {
		if(classTimings == null)
			classTimings = new Hashtable<Integer, ArrayList<ClassSubjectDayTiming>>();
		
		return classTimings.get(day);
	}

	public void setClassTimings(
			Hashtable<Integer, ArrayList<ClassSubjectDayTiming>> classTimings) {
		this.classTimings = classTimings;
	}*/

	public ArrayList<DayTiming> getDays() {
		if(days == null)
			days = new ArrayList<DayTiming>();
		return days;
	}

	public void setDays(ArrayList<DayTiming> days) {
		this.days = days;
	}

	public ArrayList<DayTiming> getDays2() {
		if(days2 == null)
		{
			LoadStaffTimetable();
		}
		return days2;
	}

	public void setDays2(ArrayList<DayTiming> days2) {
		this.days2 = days2;
	}

	public ClassSubjectDayTiming getCsdt() {
		if(csdt == null)
			csdt = new ClassSubjectDayTiming();
		return csdt;
	}

	public void setCsdt(ClassSubjectDayTiming csdt) {
		this.csdt = csdt;
	}
	
}
