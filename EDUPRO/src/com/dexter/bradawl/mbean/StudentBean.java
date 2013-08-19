package com.dexter.bradawl.mbean;

import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.util.ArrayList;
import java.util.Hashtable;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.log.Log;
import org.richfaces.event.UploadEvent;
import org.richfaces.model.UploadItem;

import com.dexter.bradawl.dto.Chart;
import com.dexter.bradawl.dto.Guardian;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Score;
import com.dexter.bradawl.dto.Search;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.StudentMedical;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.StudentModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("studentBean")
@Scope(ScopeType.SESSION)
public class StudentBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@Logger
	private Log log;
	
	@In
	AppOptions appOptions;
	
	private Student viewingStudent;
	private Student student;
	private Guardian guardian;
	private String guardianSearchName;
	private ArrayList<Guardian> searchGuardians;
	private Ref club;
	private StudentMedical medical;
	
	private int admission_step_page;
	private String admission_step_title;
	
	private UploadItem uploadItem;
	
	private ArrayList<Student> guardianStudents;
	private ArrayList<Student> studentsSearchList;
	
	private Search search;
	
	private ArrayList<Score> session_scores;
	
	public void SearchGuardian()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Searching for guardians to add to the student's list");
		
		if(getGuardianSearchName() != null)
		{
			setSearchGuardians(new StudentModel().searchGuardians(getGuardianSearchName()));
		}
	}
	
	/**
	 * Adds a guardian to a student's list
	 * */
	public void AddGuardian()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Adding a guardian to the student's list");
		
		if(getSearchGuardians().size() > 0)
		{
			for(Guardian e : getSearchGuardians())
			{
				if(e != null && e.getHasUser())
				{
					boolean exists = false;
					for(int i=0; i<getStudent().getGuardians().size(); i++)
					{
						Guardian g = getStudent().getGuardians().get(i);
						
						if(e.getName().equalsIgnoreCase(g.getName()))
						{
							exists = true;
							break;
						}
					}
					
					if(!exists)
					{
						getStudent().getGuardians().add(e);
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("add.success", null), null));
					}
				}
			}
			
			setSearchGuardians(null);
		}
		
		if(getGuardian().getName() != null)
		{
			boolean exists = false;
			for(int i=0; i<getStudent().getGuardians().size(); i++)
			{
				Guardian g = getStudent().getGuardians().get(i);
				
				if(getGuardian().getName().equalsIgnoreCase(g.getName()))
				{
					exists = true;
					break;
				}
			}
			
			if(!exists)
			{
				boolean valid = true;
				
				if(getGuardian().getHasUser())
				{
					if(getGuardian().getAddress().getEmail().trim().length() == 0)
					{
						valid = false;
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("guardian.user.email.required", null), null));
					}
					else if(!getGuardian().getAddress().getEmail().equalsIgnoreCase(getGuardian().getEmail()))
					{
						valid = false;
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("staff.email.notconfirmed", null), null));
					}
				}
				
				if(valid)
				{
					getStudent().getGuardians().add(getGuardian());
					setGuardian(null);
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("add.success", null), null));
				}
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
			}
		}
	}
	/**
	 * Removes a guardian from the list
	 * */
	public void RemoveGuardian()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Removing a guardian from the student's list");
		
		if(getGuardian().getName() != null)
		{
			boolean remove = false;
			
			for(int i=0; i<getStudent().getGuardians().size(); i++)
			{
				Guardian g = getStudent().getGuardians().get(i);
				if(getGuardian().getName().equalsIgnoreCase(g.getName()))
				{
					getStudent().getGuardians().remove(i);
					setGuardian(null);
					remove = true;
					break;
				}
			}
			if(remove)
			{
				getStudent().getGuardians().trimToSize();
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("remove.success", null), null));
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.notfound", null), null));
			}
		}
	}
	
	/**
	 * Adds a club to the student's list of clubs
	 * */
	public void AddClub()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Adding a club to the student's list");
		
		if(getClub().getId() > 0)
		{
			boolean exists = false;
			for(Ref e : getStudent().getClubs())
			{
				if(e.getId() == getClub().getId())
				{
					exists = true;
					break;
				}
			}
			
			if(!exists)
			{
				ArrayList<Ref> list = new RefModel().getRefObjects(11);
				for(Ref e : list)
				{
					if(e.getId() == getClub().getId())
					{
						getClub().setName(e.getName());
						break;
					}
				}
				
				getStudent().getClubs().add(getClub());
				setClub(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("add.success", null), null));
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
			}
		}
	}
	
	/**
	 * Removes a club from the student's list
	 * */
	public void RemoveClub()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Removing a club from the student's list");
		
		if(getClub().getId() > 0)
		{
			boolean remove = false;
			for(int i=0; i<getStudent().getClubs().size(); i++)
			{
				Ref e = getStudent().getClubs().get(i);
				if(e.getId() == getClub().getId())
				{
					getStudent().getClubs().remove(i);
					setClub(null);
					remove = true;
					break;
				}
			}
			if(remove)
			{
				getStudent().getClubs().trimToSize();
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("remove.success", null), null));
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.notfound", null), null));
			}
		}
	}
	
	/**
	 * Adds a medical result to a student's list
	 * */
	public void AddMedical()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Adding a medical to the student's list");
		
		if(getMedical().getMedical_test_id() > 0)
		{
			boolean exists = false;
			for(StudentMedical sm : getStudent().getMedicals())
			{
				if(sm.getMedical_test_id() == getMedical().getMedical_test_id())
				{
					exists = true;
					break;
				}
			}
			
			if(!exists)
			{
				getStudent().getMedicals().add(getMedical());
				setMedical(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("add.success", null), null));
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
			}
		}
	}
	
	/**
	 * Removes a medical from a student's list
	 * */
	public void RemoveMedical()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Removing a medical from the student's list");
		
		if(getMedical().getMedical_test_id() > 0)
		{
			boolean remove = false;
			for(int i=0; i<getStudent().getMedicals().size(); i++)
			{
				StudentMedical sm = getStudent().getMedicals().get(i);
				if(sm.getMedical_test_id() == getMedical().getMedical_test_id())
				{
					getStudent().getMedicals().remove(i);
					remove = true;
					break;
				}
			}
			if(remove)
			{
				getStudent().getMedicals().trimToSize();
				setMedical(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("remove.success", null), null));
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.notfound", null), null));
			}
		}
	}
	
	public void MoveNext(int page)
	{
		setAdmission_step_page(page);
		switch(page)
		{
			case 1:
			{
				setAdmission_step_title("Student details");
				break;
			}
			case 2:
			{
				setAdmission_step_title("Guardian(s) details");
				break;
			}
			case 3:
			{
				setAdmission_step_title("Medical details");
				break;
			}
			case 4:
			{
				setAdmission_step_title("Other details");
				break;
			}
			case 5:
			{
				setAdmission_step_title("Documents");
				break;
			}
		}
	}
	
	/**
	 * Uploads a new staff's photo
	 * */
	public void sphotolisterner(UploadEvent event) throws Exception
	{
		UploadItem item = event.getUploadItem();
		setUploadItem(item); // store the uploaded item, until student is SAVED
	}
	
	public void AdmitStudent()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Admitting a student");
		
		// now we get the user id and set it to the student's user_id
		int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
		getStudent().setUser_id(user_id);
		
		int ret = new StudentModel().admitStudent(getStudent());
		switch(ret)
		{
			case 0:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("student.admit.success", null), null));
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("user.created.details", new Object[]{getStudent().getUser().getUsername(), "password"}), null));
				
				// Copying the files into the disk using the new id
				boolean savesuccess = false;
				try
				{
					if(getUploadItem() != null)
					{
						log.info("Saving student photo...");
						
						java.io.File tempFile = getUploadItem().getFile();
						Utils.copyFile(new FileInputStream(tempFile), new FileOutputStream(appOptions.getFileSavePath() + "/students/" + getStudent().getStudent_id()));
						savesuccess = true;
						
						log.info("Done");
					}
				}
				catch(Exception ex)
				{
					log.fatal("Error saving student photo: " + ex.getMessage());
					ex.printStackTrace();
				}
				
				if(!savesuccess && getUploadItem() != null)
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("photo.upload.error", null), null));
				
				clear();
				break;
			}
			case 2:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
				break;
			}
			default:
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
				break;
			}
		}
	}
	
	public void SearchStudents()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Searching for students...");
		setViewingStudent(null);
		setStudentsSearchList(null);
		ArrayList<Student> list = new StudentModel().getStudentsBySearch(getStudent());
		setStudentsSearchList(list);
		if(getStudentsSearchList().size() > 0)
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getStudentsSearchList().size()}), null));
		else
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
	}

	public void ViewStudent()
	{
		if(getViewingStudent() != null && getViewingStudent().getStudent_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Viewing student: " + getViewingStudent().getStudent_fn() + " " + getViewingStudent().getStudent_ln() + "...");
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("student.viewing", new Object[] {getViewingStudent().getStudent_fn() + " " + getViewingStudent().getStudent_ln()}), null));
		}
	}
	
	public void AddClubToDB()
	{}
	
	public void RemoveClubFromDB()
	{}
	
	public void AddMedicalToDB()
	{}
	
	public void RemoveMedicalFromDB()
	{}
	
	public void AddGuardianToDB()
	{}
	
	public void RemoveGuardianFromDB()
	{}
	
	public void UpdateStudent(int type)
	{}
	
	private Hashtable<String, ArrayList<Chart>> chart;
	
	public void ViewPerformanceHistory()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Viewing student performance...");
		
		setChart(null);
		
		if(getSearch().getStudent_id() > 0 && getSearch().getSession_id() > 0)
		{
			setSession_scores(new StudentModel().getStudentSessionSubsScores(getSearch().getSession_id(), getSearch().getStudent_id(), getSearch().getSub_id()));
			if(getSession_scores().size() > 0)
			{
				ArrayList<Score> list = getSession_scores();
				for(Score e : list)
				{
					Chart c = new Chart();
					c.setPeriod(e.getSession_nm() + ", " + e.getTerm_nm());
					c.setValue(e.getTotal_score());
					if(getChart().containsKey(e.getSub_nm()))
					{
						getChart().get(e.getSub_nm()).add(c);
					}
					else
					{
						ArrayList<Chart> l = new ArrayList<Chart>();
						l.add(c);
						getChart().put(e.getSub_nm(), l);
					}
				}
				
				for(String s : getChart().keySet())
				{
					System.out.println(s);
				}
				
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getSession_scores().size()}), null));
			}
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
		}
	}
	
	public void clear()
	{
		setStudent(null);
		setClub(null);
		setGuardian(null);
		setMedical(null);
		setViewingStudent(null);
		setUploadItem(null);
		setStudentsSearchList(null);
		
		admission_step_page = 0;
		admission_step_title = null;
	}
	
	public Student getViewingStudent()
	{
		if(viewingStudent == null)
			viewingStudent = new Student();
		return viewingStudent;
	}
	public void setViewingStudent(Student viewingStudent)
	{
		this.viewingStudent = viewingStudent;
	}
	public Student getStudent()
	{
		if(student == null)
			student = new Student();
		return student;
	}

	public void setStudent(Student student)
	{
		this.student = student;
	}

	public Guardian getGuardian()
	{
		if(guardian == null)
			guardian = new Guardian();
		return guardian;
	}

	public String getGuardianSearchName() {
		return guardianSearchName;
	}

	public void setGuardianSearchName(String guardianSearchName) {
		this.guardianSearchName = guardianSearchName;
	}

	public void setGuardian(Guardian guardian)
	{
		this.guardian = guardian;
	}

	public ArrayList<Guardian> getSearchGuardians() {
		if(searchGuardians == null)
			searchGuardians = new ArrayList<Guardian>();
		return searchGuardians;
	}

	public void setSearchGuardians(ArrayList<Guardian> searchGuardians) {
		this.searchGuardians = searchGuardians;
	}

	public Ref getClub()
	{
		if(club == null)
			club = new Ref();
		return club;
	}

	public void setClub(Ref club)
	{
		this.club = club;
	}

	public StudentMedical getMedical()
	{
		if(medical == null)
			medical = new StudentMedical();
		return medical;
	}

	public void setMedical(StudentMedical medical)
	{
		this.medical = medical;
	}
	
	public int getAdmission_step_page()
	{
		if(admission_step_page == 0)
			admission_step_page = 1;
		return admission_step_page;
	}
	public void setAdmission_step_page(int admission_step_page)
	{
		this.admission_step_page = admission_step_page;
	}
	public String getAdmission_step_title()
	{
		if(admission_step_title == null || admission_step_title.trim().length() == 0)
			admission_step_title = "Student details";
		return admission_step_title;
	}
	public void setAdmission_step_title(String admission_step_title)
	{
		this.admission_step_title = admission_step_title;
	}
	
	public ArrayList<Student> getGuardianStudents() {
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		int guardian_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getGuardian().getGuardian_id();
		guardianStudents = new StudentModel().getGuardianStudents(guardian_id);
		return guardianStudents;
	}

	public void setGuardianStudents(ArrayList<Student> guardianStudents) {
		this.guardianStudents = guardianStudents;
	}

	public ArrayList<Student> getStudentsSearchList()
	{
		return studentsSearchList;
	}
	
	public void setStudentsSearchList(ArrayList<Student> studentsSearchList)
	{
		this.studentsSearchList = studentsSearchList;
	}
	
	public UploadItem getUploadItem()
	{
		return uploadItem;
	}

	public void setUploadItem(UploadItem uploadItem)
	{
		this.uploadItem = uploadItem;
	}
	public Search getSearch() {
		if(search == null)
			search = new Search();
		return search;
	}
	public void setSearch(Search search) {
		this.search = search;
	}
	public ArrayList<Score> getSession_scores() {
		if(session_scores == null)
			session_scores = new ArrayList<Score>();
		return session_scores;
	}
	public void setSession_scores(ArrayList<Score> session_scores) {
		this.session_scores = session_scores;
	}
	public Hashtable<String, ArrayList<Chart>> getChart() {
		if(chart == null)
			chart = new Hashtable<String, ArrayList<Chart>>();
		return chart;
	}
	public void setChart(Hashtable<String, ArrayList<Chart>> chart) {
		this.chart = chart;
	}
	
}
