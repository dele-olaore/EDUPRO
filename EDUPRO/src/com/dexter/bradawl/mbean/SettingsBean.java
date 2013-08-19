package com.dexter.bradawl.mbean;

import java.util.ArrayList;
import java.util.Date;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.log.Log;

import com.dexter.bradawl.dto.Award;
import com.dexter.bradawl.dto.ClassSubject;
import com.dexter.bradawl.dto.DayTiming;
import com.dexter.bradawl.dto.Grade;
import com.dexter.bradawl.dto.Grading;
import com.dexter.bradawl.dto.NewSSS;
import com.dexter.bradawl.dto.Prefect;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Session;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.dto.Term;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.SessionModel;
import com.dexter.bradawl.model.StaffModel;
import com.dexter.bradawl.model.StudentModel;
import com.dexter.bradawl.model.TimetableModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("settingsBean")
@Scope(ScopeType.SESSION)
public class SettingsBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@Logger
	private Log log;
	
	@In
	private AppOptions appOptions;
	
	/**
	 * For all reference objects creation and updates.
	 * */
	private Ref refOBJ, news, event;
	
	private ArrayList<Ref> titles, relationships, documentTypes, medical_tests, medical_results, blocks, clubs, houses, awards, prefectships, hostels, newsArr, eventsArr, searchNewsArr, searchEventsArr, upcomingEvents;
	
	private ArrayList<Ref> presentingAwards; // holds awards to be presented
	private Award presentAward;
	private ArrayList<Award> sessionAwards;
	
	/**
	 * setting for grades
	 * */
	private ArrayList<Grade> grades;
	private Grade grade;
	private ArrayList<Grading> gradings;
	private Grading grading;
	
	/**
	 * setting for subjects
	 * */
	private ArrayList<Ref> subjects, staffSubjects;
	private Ref subject;
	
	private ArrayList<ClassSubject> classSubjects;
	private ClassSubject class_subject;
	
	private ArrayList<Staff> classSubjectStaffs;
	
	/**
	 * setting for classes
	 * */
	private ArrayList<com.dexter.bradawl.dto.Class> classes;
	private com.dexter.bradawl.dto.Class clss;
	
	/**
	 * settings for session and terms
	 * */
	private Session session, newsession;
	private Term term, newterm;
	private ArrayList<Term> sessionTerms;
	
	/**
	 * For new SSS 1 students mapping.
	 * */
	private NewSSS newSSS;
	
	/**
	 * For timetable settings
	 * */
	private DayTiming dayTiming;
	private ArrayList<DayTiming> timings;
	
	/**
	 * For prefectships.
	 * */
	private Prefect prefect;
	private ArrayList<Prefect> sessionPrefects, currentPrefects;
	
	/**
	 * Creates a new subject
	 * */
	public void CreateRefObject(int type)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Creating a reference object of type: " + type);
		
		int ret = new RefModel().createRefObjects(type, getRefOBJ());
		
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				reset();
				
				break;
			}
			case -2:
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
	
	/**
	 * Updates reference objects
	 * */
	public void UpdateRefObject(int type)
	{}
	
	/**
	 * Updates a grade value.
	 * */
	public void UpdateGrade()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Updating a grade");
		
		int ret = getGrade().updateMe();
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.success", null), null));
				break;
			}
			case -2:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.duplicate", null), null));
				break;
			}
			default:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.failed", null), null));
				break;
			}
		}
		
		setGrade(null);
	}
	
	/**
	 * Resets grades to their default values
	 * */
	public void ResetGrades()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Resetting grades");
		
		int ret = new RefModel().ResetGrades();
		
		if(ret == 0)
		{
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("reset.success", null), null));
		}
		else if(ret == 1)
		{
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("reset.failed", null), null));
		}
		else
		{
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("reset.error", null), null));
		}
	}
	
	/**
	 * Creates a new subject
	 * */
	public void CreateSubject()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Creating a subject");
		
		int ret = new RefModel().CUSubject(getSubject(), false);
		
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				reset();
				
				break;
			}
			case -2:
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
	
	/**
	 * Updates a new subject
	 * */
	public void UpdateSubject()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Updating a subject");
		
		int ret = new RefModel().CUSubject(getSubject(), true);
		
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.success", null), null));
				reset();
				
				break;
			}
			case -2:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.duplicate", null), null));
				
				break;
			}
			default:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.failed", null), null));
				break;
			}
		}
	}
	
	/**
	 * Creates a new class
	 * */
	public void CreateClass()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Creating a class");
		
		int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
		getClss().setUser_id(user_id);
		getClss().setFee_cat_id(0);
		
		int ret = getClss().CreateMe();
		
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				setClss(null);
				
				break;
			}
			case -2:
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
	
	/**
	 * Updates a class
	 * */
	public void UpdateClass()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Updating a class");
		
		int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
		getClss().setUser_id(user_id);
		
		int ret = getClss().UpdateMe();
		
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.success", null), null));
				setClss(null);
				setClasses(null);
				break;
			}
			case -2:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.duplicate", null), null));
				break;
			}
			default:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.failed", null), null));
				break;
			}
		}
	}
	
	/**
	 * Maps a staff to a subject.
	 * */
	public void MapStafftoSubject(int type)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Mapping a staff to a subject");
		
		if(type == 1) // map
		{
			if(getRefOBJ().getId2() > 0 && getRefOBJ().getId3() > 0)
			{
				int ret = new StaffModel().MapStaffToSubject(getRefOBJ());
				switch(ret)
				{
					case 0:
					{
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
						getRefOBJ().setId2(0);
						
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
		}
		else if(type == 2) // un-map
		{
			
		}
	}
	
	/**
	 * Maps a class to a subject.
	 * */
	public void MapClasstoSubject(int type)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Mapping a class to a subject");
		
		if(type == 1) // map
		{
			if(getClass_subject().getClass_id() > 0 && getClass_subject().getSub_id() > 0)
			{
				int ret = new RefModel().MapSubjectToClass(getClass_subject());
				switch(ret)
				{
					case 0:
					{
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
						getClass_subject().setSub_id(0);
						
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
		}
		else if(type == 2) // un-map
		{
			
		}
	}
	
	/**
	 * Maps a subject teacher for a class
	 * */
	public void MapStaffSubjecttoClass(int type)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Mapping a subject teacher for a class");
		
		if(type == 1)
		{
			if(getRefOBJ().getId() > 0 && getRefOBJ().getId2() > 0 && getRefOBJ().getId3() > 0)
			{
				int ret = new RefModel().MapSubjectTeacherToClass(getRefOBJ());
				switch(ret)
				{
					case 0:
					{
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
						getClass_subject().setSub_id(0);
						
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
		}
		else if(type == 2)
		{
			
		}
	}
	
	/**
	 * Starts a new session.
	 * This will consider the first term with in the academic session
	 * */
	public void StartNewSession()
	{
		if(newsession != null && newsession.getSession_nm() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Starting a new academic session");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			int ret = new SessionModel().StartNewSession(newsession, user_id);
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("session.start.success", null), null));
					setNewsession(null);
					setSessionTerms(null);
					setSession(null);
					setCurrentTerm(null);
					appOptions.setSession(null);
					appOptions.setCurrentTerm(null);
					break;
				}
				case 1:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("session.start.error", null), null));
					break;
				}
				case -1:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("session.start.error", null), null));
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("session.start.error.sessionactive", null), null));
					break;
				}
				case 3:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("session.start.error.startdateinvalid", null), null));
					break;
				}
			}
		}
	}
	
	/**
	 * Starts a new term with the current session.
	 * */
	public void StartNewTerm()
	{
		if(getNewterm() != null && getNewterm().getTerm_nm() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Starting a new academic term within the current session");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			int ret = new SessionModel().StartNewTerm(getNewterm(), user_id);
			log.info("ret: " + ret);
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("term.start.success", null), null));
					setNewterm(null);
					setSessionTerms(null);
					setCurrentTerm(null);
					// appOptions.setSession(null);
					appOptions.setCurrentTerm(null);
					break;
				}
				case 1:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
				case -1:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
				case -2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				case 3:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.maxterms", null), null));
					break;
				}
				case 4:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error.termactive", null), null));
					break;
				}
				case 5:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
			}
		}
	}
	
	public void UpdateTerm()
	{
		if(getTerm() != null && getTerm().getTerm_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Starting a new academic term within the current session");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			int ret = new SessionModel().UpdateTerm(getTerm(), user_id);
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("term.update.success", null), null));
					setSessionTerms(null);
					setCurrentTerm(null);
					setTerm(null);
					appOptions.setCurrentTerm(null);
					
					break;
				}
				case 1:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
				case -1:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
				case -2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error", null), null));
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error.termactive", null), null));
					break;
				}
				case 3:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("term.start.error.startdateinvalid", null), null));
					break;
				}
			}
		}
	}
	
	public void MapNewSSS1Students()
	{
		if(getNewSSS() != null && getNewSSS().getStudents().size() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Moving the previous jss 3 students to their sss 1 classes");
			
			// int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			String ret = new StudentModel().mapStudentToClass(getNewSSS().getStudents(), getNewSSS().getClass_id2());
			if(ret.indexOf("success")>=0)
			{
				setNewSSS(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, ret, null));
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, ret, null));
			}
		}
	}
	
	public void PostNews()
	{
		if(getNews() != null && getNews().getNews_headline() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Posting news");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getNews().setUser_id(user_id);
			
			int ret = new RefModel().createRefObjects(11, getNews());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setNews(null);
					setNewsArr(null);
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
	}
	
	public String SearchNews()
	{
		if(getRefOBJ() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			setSearchNewsArr(new RefModel().GetNews(getRefOBJ()));
			
			if(getSearchNewsArr().size() > 0)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getSearchNewsArr().size()}), null));
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
		}
		
		return "newsSearch";
	}
	
	public void PostNewsComment()
	{
		if(getNews().getNews_headline() != null && getNews().getDesc() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Posting comment for a news");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getNews().setUser_id(user_id);
			
			RefModel rm = new RefModel();
			
			int ret = rm.PostNewsComment(getNews());
			switch(ret)
			{
				case 0:
				{
					getNews().setNewsComments(rm.GetNewsComments(getNews().getId()));
					getNews().setDesc(null);
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
	}
	
	public void PostEvent()
	{
		if(getEvent() != null && getEvent().getTitle() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Posting event");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getEvent().setUser_id(user_id);
			
			int ret = new RefModel().createRefObjects(12, getEvent());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setEvent(null);
					setEventsArr(null);
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
	}
	
	public String SearchEvents()
	{
		setSearchEventsArr(null);
		return "eventsSearch";
	}
	
	public String ViewEvent(int id)
	{
		String ret = "events";
		
		if(id > 0)
		{
			ArrayList<Ref> list = getSearchEventsArr();
			for(Ref e : list)
			{
				if(e.getId() == id)
				{
					setEvent(e);
					break;
				}
			}
		}
		
		return ret;
	}
	
	public void InsertDayTiming()
	{
		if(getDayTiming() != null && getDayTiming().getStart_time_hr() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting day timing");
			
			getDayTiming().setStart_time((getDayTiming().getStart_time_hr()*60)+getDayTiming().getStart_time_min());
			getDayTiming().setEnd_time((getDayTiming().getEnd_time_hr()*60)+getDayTiming().getEnd_time_min());
			getDayTiming().setBrk_start_time((getDayTiming().getBrk_start_time_hr()*60)+getDayTiming().getBrk_start_time_min());
			getDayTiming().setBrk_end_time(getDayTiming().getBrk_start_time()+getDayTiming().getBrk_dur_min());
			
			int ret = new TimetableModel().InsertDayTimingSettings(getDayTiming());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setDayTiming(null);
					setTimings(null);
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
	}
	
	public void UpdateDayTiming()
	{
		if(getDayTiming() != null && getDayTiming().getStart_time_hr() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Updating day timing");
			
			getDayTiming().setStart_time((getDayTiming().getStart_time_hr()*60)+getDayTiming().getStart_time_min());
			getDayTiming().setEnd_time((getDayTiming().getEnd_time_hr()*60)+getDayTiming().getEnd_time_min());
			getDayTiming().setBrk_start_time((getDayTiming().getBrk_start_time_hr()*60)+getDayTiming().getBrk_start_time_min());
			getDayTiming().setBrk_end_time(getDayTiming().getBrk_start_time()+getDayTiming().getBrk_dur_min());
			
			int ret = new TimetableModel().UpdateDayTimingSettings(getDayTiming());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.success", null), null));
					setDayTiming(null);
					setTimings(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void AssignPrefectShip()
	{
		if(getSession() != null && getSession().getSession_id() > 0 && getPrefect().getPrefect_id() > 0 && getPrefect().getStudent_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getPrefect().setUser_id(user_id);
			getPrefect().setSession_id(getSession().getSession_id());
			int ret = new StudentModel().AssignPrefect(getPrefect());
			
			switch(ret)
			{
			case 0:
			{
				setPrefect(null);
				setCurrentPrefects(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				break;
			}
			case 2: case 3:
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
	}
	
	public void RemovePrefectshipAssignment()
	{}
	
	public void PresentTheAward()
	{
		if(getPresentAward().getId() > 0 && getPresentAward().getTypeStr() != null && getPresentAward().getTypeStr().length() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getPresentAward().setUser_id(user_id);
			
			int ret = new RefModel().PresentAward(getPresentAward(), getSession().getSession_id()); // for current session
			switch(ret)
			{
			case 0:
			{
				setPresentAward(null);
				setSessionAwards(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				break;
			}
			case 1:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.failed", null), null));
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
	}
	
	public void reset()
	{
		setTitles(null);
		setRelationships(null);
		setMedical_tests(null);
		setMedical_results(null);
		setBlocks(null);
		setClubs(null);
		setHouses(null);
		setHostels(null);
		
		setGrade(null);
		setSubject(null);
		setSubjects(null);
		
		setClasses(null);
		setClss(null);
		
		setTerm(null);
		setRefOBJ(null);
		
		setNews(null);
		setEvent(null);
		
		setAwards(null);
		setPrefectships(null);
		setDocumentTypes(null);
	}

	public ArrayList<com.dexter.bradawl.dto.Class> getClasses()
	{
		if(classes == null)
			classes = new RefModel().getClasses();
		
		for(com.dexter.bradawl.dto.Class e : classes)
		{
			if(e.getStaff_id() > 0)
			{
				Staff st = new StaffModel().getStaffByID(e.getStaff_id());
				if(st != null)
					e.setStaff_nm(st.getStaff_fn() + " " + st.getStaff_mn() + " " + st.getStaff_ln());
				else
					e.setStaff_nm("N/A");
			}
		}
		
		return classes;
	}

	public void setClasses(ArrayList<com.dexter.bradawl.dto.Class> classes)
	{
		this.classes = classes;
	}

	public com.dexter.bradawl.dto.Class getClss()
	{
		if(clss == null)
		{
			clss = new com.dexter.bradawl.dto.Class();
		}
		
		return clss;
	}

	public void setClss(com.dexter.bradawl.dto.Class clss)
	{
		this.clss = clss;
	}

	public ArrayList<Ref> getTitles()
	{
		if(titles == null)
			titles = new RefModel().getRefObjects(6);
		
		return titles;
	}

	public void setTitles(ArrayList<Ref> titles)
	{
		this.titles = titles;
	}

	public ArrayList<Ref> getRelationships()
	{
		if(relationships == null)
			relationships = new RefModel().getRefObjects(7);
		
		return relationships;
	}

	public void setRelationships(ArrayList<Ref> relationships)
	{
		this.relationships = relationships;
	}

	public ArrayList<Ref> getMedical_tests()
	{
		if(medical_tests == null)
			medical_tests = new RefModel().getRefObjects(8);
		
		return medical_tests;
	}

	public void setMedical_tests(ArrayList<Ref> medical_tests)
	{
		this.medical_tests = medical_tests;
	}

	public ArrayList<Ref> getMedical_results()
	{
		if(medical_results == null)
			medical_results = new RefModel().getRefObjects(9);
		
		return medical_results;
	}

	public void setMedical_results(ArrayList<Ref> medical_results)
	{
		this.medical_results = medical_results;
	}

	public ArrayList<Ref> getBlocks()
	{
		if(blocks == null)
			blocks = new RefModel().getRefObjects(10);
		
		return blocks;
	}

	public void setBlocks(ArrayList<Ref> blocks)
	{
		this.blocks = blocks;
	}

	public ArrayList<Ref> getClubs()
	{
		if(clubs == null)
			clubs = new RefModel().getRefObjects(11);
		
		return clubs;
	}

	public void setClubs(ArrayList<Ref> clubs)
	{
		this.clubs = clubs;
	}

	public ArrayList<Ref> getHouses()
	{
		if(houses == null)
			houses = new RefModel().getRefObjects(12);
		
		return houses;
	}

	public void setHouses(ArrayList<Ref> houses)
	{
		this.houses = houses;
	}

	public ArrayList<Ref> getAwards()
	{
		if(awards == null)
			awards = new RefModel().getRefObjects(14);
		
		return awards;
	}

	public void setAwards(ArrayList<Ref> awards)
	{
		this.awards = awards;
	}

	public ArrayList<Ref> getPrefectships()
	{
		if(prefectships == null)
			prefectships = new RefModel().getRefObjects(15);
		
		return prefectships;
	}

	public void setPrefectships(ArrayList<Ref> prefectships)
	{
		this.prefectships = prefectships;
	}

	public ArrayList<Ref> getHostels()
	{
		if(hostels == null)
			hostels = new RefModel().getRefObjects(13);
		
		return hostels;
	}

	public void setHostels(ArrayList<Ref> hostels)
	{
		this.hostels = hostels;
	}

	public ArrayList<Ref> getNewsArr()
	{
		if(newsArr == null || (newsArr != null && newsArr.size() == 0))
		{
			newsArr = new RefModel().GetNews(3);
		}
		return newsArr;
	}

	public void setNewsArr(ArrayList<Ref> newsArr)
	{
		this.newsArr = newsArr;
	}

	public ArrayList<Ref> getUpcomingEvents()
	{
		if(upcomingEvents == null)
			upcomingEvents = new RefModel().GetEvents(3, 1);
		
		return upcomingEvents;
	}
	
	public ArrayList<Ref> getEventsArr()
	{
		if(eventsArr == null || (eventsArr != null && eventsArr.size() == 0))
		{
			eventsArr = new RefModel().GetEvents(3, 0);
		}
		return eventsArr;
	}

	public void setEventsArr(ArrayList<Ref> eventsArr)
	{
		this.eventsArr = eventsArr;
	}

	public ArrayList<Ref> getSearchNewsArr()
	{
		if(searchNewsArr == null)
			searchNewsArr = new ArrayList<Ref>();
		return searchNewsArr;
	}

	public void setSearchNewsArr(ArrayList<Ref> searchNewsArr)
	{
		this.searchNewsArr = searchNewsArr;
	}

	public ArrayList<Ref> getSearchEventsArr()
	{
		if(searchEventsArr == null)
		{
			searchEventsArr = new RefModel().GetEvents(0, 0);
		}
		return searchEventsArr;
	}

	public void setSearchEventsArr(ArrayList<Ref> searchEventsArr)
	{
		this.searchEventsArr = searchEventsArr;
	}

	public Ref getRefOBJ()
	{
		if(refOBJ == null)
			refOBJ = new Ref();
		return refOBJ;
	}

	public void setRefOBJ(Ref refOBJ)
	{
		this.refOBJ = refOBJ;
	}

	public Ref getNews()
	{
		if(news == null)
			news = new Ref();
		
		return news;
	}

	public void setNews(Ref news)
	{
		this.news = news;
	}
	
	public String setViewingNews(Ref news)
	{
		setNews(news);
		return "news";
	}

	public Ref getEvent()
	{
		if(event == null)
			event = new Ref();
		return event;
	}

	public void setEvent(Ref event)
	{
		this.event = event;
	}
	
	public String setViewingEvent(Ref event)
	{
		setEvent(event);
		return "events";
	}
	
	public String getEventForViewing(String id)
	{
		System.out.println("viewing event: " + id);
		try
		{
			setEvent(new RefModel().GetEventByID(Integer.parseInt(id)));
		}
		catch(Exception ex){}
		
		return "events";
	}

	public ArrayList<Ref> getPresentingAwards()
	{
		if(presentingAwards == null)
			presentingAwards = new ArrayList<Ref>();
		
		presentingAwards.clear();
		
		if(getPresentAward().getTypeStr() != null)
		{
			for(Ref aw : getAwards())
			{
				if(aw.getType().equalsIgnoreCase(getPresentAward().getTypeStr()))
					presentingAwards.add(aw);
			}
		}
		return presentingAwards;
	}

	public void setPresentingAwards(ArrayList<Ref> presentingAwards)
	{
		this.presentingAwards = presentingAwards;
	}

	public Award getPresentAward()
	{
		if(presentAward == null)
			presentAward = new Award();
		return presentAward;
	}

	public void setPresentAward(Award presentAward)
	{
		this.presentAward = presentAward;
	}

	public ArrayList<Award> getSessionAwards()
	{
		if(sessionAwards == null)
			sessionAwards = new RefModel().GetSessionAwards(0); // current session awards.
		
		return sessionAwards;
	}

	public void setSessionAwards(ArrayList<Award> sessionAwards)
	{
		this.sessionAwards = sessionAwards;
	}

	public ArrayList<Grade> getGrades()
	{
		if(grades == null)
			grades = new RefModel().getGrades();
		
		return grades;
	}

	public void setGrades(ArrayList<Grade> grades)
	{
		this.grades = grades;
	}

	public Grade getGrade()
	{
		if(grade == null)
		{
			grade = new Grade();
		}
		
		return grade;
	}

	public void setGrade(Grade grade)
	{
		this.grade = grade;
	}

	public ArrayList<Grading> getGradings()
	{
		if(gradings == null)
		{
			try
			{
				int session_id = appOptions.getSession().getSession_id();
				gradings = new RefModel().getGradings(session_id);
			}
			catch(Exception ex)
			{}
			
			if(gradings == null)
				gradings = new ArrayList<Grading>();
		}
		return gradings;
	}

	public void setGradings(ArrayList<Grading> gradings)
	{
		this.gradings = gradings;
	}

	public Grading getGrading()
	{
		if(grading == null)
			grading = new Grading();
		return grading;
	}

	public void setGrading(Grading grading)
	{
		this.grading = grading;
	}

	public ArrayList<Ref> getSubjects()
	{
		if(subjects == null)
			subjects = new RefModel().getRefObjects(4);
		
		return subjects;
	}

	public void setSubjects(ArrayList<Ref> subjects)
	{
		this.subjects = subjects;
	}

	public ArrayList<Ref> getStaffSubjects()
	{
		if(getRefOBJ().getId3() > 0)
		{
			staffSubjects = new StaffModel().GetStaffSubjects(getRefOBJ().getId3());
		}
		else
		{
			if(staffSubjects == null)
				staffSubjects = new ArrayList<Ref>();
			
			staffSubjects.clear();
		}
		
		return staffSubjects;
	}

	public void setStaffSubjects(ArrayList<Ref> staffSubjects)
	{
		this.staffSubjects = staffSubjects;
	}

	public ArrayList<ClassSubject> getClassSubjects()
	{
		if(getClass_subject().getClass_id() > 0)
		{
			classSubjects = new RefModel().GetClassSubjects(getClass_subject().getClass_id());
		}
		else
		{
			if(classSubjects == null)
				classSubjects = new ArrayList<ClassSubject>();
			
			classSubjects.clear();
		}
		return classSubjects;
	}

	public void setClassSubjects(ArrayList<ClassSubject> classSubjects)
	{
		this.classSubjects = classSubjects;
	}

	public ClassSubject getClass_subject()
	{
		if(class_subject == null)
			class_subject = new ClassSubject();
		return class_subject;
	}

	public void setClass_subject(ClassSubject class_subject)
	{
		this.class_subject = class_subject;
	}

	public ArrayList<Staff> getClassSubjectStaffs()
	{
		if(getRefOBJ().getId() > 0 && getRefOBJ().getId2() > 0)
		{
			classSubjectStaffs = new RefModel().GetSubjectStaffsForClass(getRefOBJ().getId(), getRefOBJ().getId2());
		}
		else
		{
			if(classSubjectStaffs == null)
				classSubjectStaffs = new ArrayList<Staff>();
			
			classSubjectStaffs.clear();
		}
		
		return classSubjectStaffs;
	}

	public void setClassSubjectStaffs(ArrayList<Staff> classSubjectStaffs)
	{
		this.classSubjectStaffs = classSubjectStaffs;
	}

	public Ref getSubject()
	{
		if(subject == null)
		{
			subject = new Ref();
		}
		
		return subject;
	}

	public void setSubject(Ref subject)
	{
		this.subject = subject;
	}

	public Session getSession()
	{
		if(session == null)
			session = new SessionModel().GetCurrentSession();
		
		return session;
	}

	public void setSession(Session session)
	{
		this.session = session;
	}
	
	private Term currentTerm;
	public Term getCurrentTerm()
	{
		if(currentTerm == null)
		{
			ArrayList<Term> list = appOptions.getSessionTerms();
			for(Term term : list)
			{
				if(term.getTerm_end_dt() == null || (term.getTerm_end_dt() != null && term.getTerm_end_dt().before(new Date())))
				{
					currentTerm = term;
					break;
				}
			}
		}
		
		return currentTerm;
	}
	
	public void setCurrentTerm(Term currentTerm)
	{
		this.currentTerm = currentTerm;
	}

	public Term getTerm()
	{
		if(term == null)
			term = new Term();
		return term;
	}

	public void setTerm(Term term)
	{
		this.term = term;
	}

	public ArrayList<Term> getSessionTerms()
	{
		if(getSession() != null)
		{
			if(sessionTerms == null)
				sessionTerms = new SessionModel().GetSessionTerms(session.getSession_id());
		}
		else
		{
			sessionTerms = new ArrayList<Term>();
		}
		
		return sessionTerms;
	}

	public void setSessionTerms(ArrayList<Term> sessionTerms)
	{
		this.sessionTerms = sessionTerms;
	}

	public Session getNewsession()
	{
		if(newsession == null)
			newsession = new Session();
		
		return newsession;
	}

	public void setNewsession(Session newsession)
	{
		this.newsession = newsession;
	}

	public Term getNewterm()
	{
		if(newterm == null)
			newterm = new Term();
		
		return newterm;
	}

	public void setNewterm(Term newterm)
	{
		this.newterm = newterm;
	}

	public NewSSS getNewSSS()
	{
		if(newSSS == null)
			newSSS = new NewSSS();
		return newSSS;
	}

	public void setNewSSS(NewSSS newSSS)
	{
		this.newSSS = newSSS;
	}

	public DayTiming getDayTiming() {
		if(dayTiming == null)
			dayTiming = new DayTiming();
		return dayTiming;
	}

	public void setDayTiming(DayTiming dayTiming) {
		this.dayTiming = dayTiming;
	}

	public ArrayList<DayTiming> getTimings() {
		// TODO: get all timing for everyday set so far for display
		if(timings == null)
		{
			timings = new TimetableModel().getTimings();
		}
		return timings;
	}

	public void setTimings(ArrayList<DayTiming> timings) {
		this.timings = timings;
	}

	public Prefect getPrefect() {
		if(prefect == null)
			prefect = new Prefect();
		return prefect;
	}

	public void setPrefect(Prefect prefect) {
		this.prefect = prefect;
	}

	public ArrayList<Prefect> getSessionPrefects() {
		if(sessionPrefects == null)
			sessionPrefects = new ArrayList<Prefect>();
		return sessionPrefects;
	}

	public void setSessionPrefects(ArrayList<Prefect> sessionPrefects) {
		this.sessionPrefects = sessionPrefects;
	}

	public ArrayList<Prefect> getCurrentPrefects() {
		if(currentPrefects == null)
			currentPrefects = new StudentModel().GetSessionPrefects(getSession().getSession_id());
		return currentPrefects;
	}

	public void setCurrentPrefects(ArrayList<Prefect> currentPrefects) {
		this.currentPrefects = currentPrefects;
	}

	public ArrayList<Ref> getDocumentTypes() {
		if(documentTypes == null)
			documentTypes = new RefModel().getRefObjects(17);
		return documentTypes;
	}

	public void setDocumentTypes(ArrayList<Ref> documentTypes) {
		this.documentTypes = documentTypes;
	}
	
}
