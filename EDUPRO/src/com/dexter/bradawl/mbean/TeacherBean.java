package com.dexter.bradawl.mbean;

import java.util.ArrayList;
import java.util.Date;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;

import com.dexter.bradawl.dto.Attendance;
import com.dexter.bradawl.dto.Grading;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Result;
import com.dexter.bradawl.dto.Score;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.Term;
import com.dexter.bradawl.dto.TermResult;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.StudentModel;
import com.dexter.bradawl.model.TeacherModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("teacherBean")
@Scope(ScopeType.SESSION)
public class TeacherBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@In
	AppOptions appOptions;
	
	private Attendance attendance, subjectAttendance;
	private ArrayList<Attendance> classStudents, classStudents2, classSubjectStudents, classSubjectStudents2;
	
	private Score score;
	private ArrayList<Score> scores, scores2;
	
	// for results generation and viewing
	private int class_id;
	private ArrayList<Result> results;
	private Result result;
	private TermResult termResult;
	private boolean[] term_result_available;
	
	private int student_id;
	private int subject_id;
	private Date date1, date2;
	private ArrayList<Attendance> studentClassAttendance, studentSubjectAttendance;
	
	public void MarkAttendance()
	{
		if(getAttendance().getClass_id() > 0 && getAttendance().getDate() != null && getClassStudents().size() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			boolean error = false, duplicates = false;
			int errorCnt = 0, dupCnt = 0;
			
			for(Attendance a : getClassStudents())
			{
				int ret = tm.MarkAttendance(a, getAttendance().getDate(), user_id);
				if(ret == 1)
				{
					error = true;
					errorCnt += 1;
				}
				else if(ret == 2)
				{
					duplicates = true;
					dupCnt += 1;
				}
			}
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.success", null), null));
			
			if(error)
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.errors", new Object[] {errorCnt}), null));
			}
			
			if(duplicates)
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.duplicates", new Object[] {dupCnt}), null));
			}
			
			setClassStudents(null);
		}
	}
	
	public void MarkStudentSubjectAttendance()
	{
		if(getSubjectAttendance().getClass_id() > 0 && getSubjectAttendance().getDate() != null && getClassSubjectStudents().size() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			boolean error = false, duplicates = false;
			int errorCnt = 0, dupCnt = 0;
			
			for(Attendance a : getClassSubjectStudents())
			{
				int ret = tm.MarkStudentSubjectAttendance(a, getSubjectAttendance().getDate(), user_id);
				if(ret == 1)
				{
					error = true;
					errorCnt += 1;
				}
				else if(ret == 2)
				{
					duplicates = true;
					dupCnt += 1;
				}
			}
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.success", null), null));
			
			if(error)
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.errors", new Object[] {errorCnt}), null));
			}
			
			if(duplicates)
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.duplicates", new Object[] {dupCnt}), null));
			}
			
			setClassStudents(null);
		}
	}
	
	public void UpdateAttendance()
	{
		if(getAttendance().getClass_id() > 0 && getAttendance().getDate() != null && getClassStudents2().size() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			boolean error = false;
			int errorCnt = 0;
			
			for(Attendance a : getClassStudents2())
			{
				int ret = tm.UpdateAttendance(a, getAttendance().getDate(), user_id);
				if(ret == 1)
				{
					error = true;
					errorCnt += 1;
				}
			}
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.updated", null), null));
			
			if(error)
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("attendance.errors", new Object[] {errorCnt}), null));
			}
			
			setClassStudents2(null);
		}
	}
	
	public void InsertScores()
	{
		if(getScore().getSub_id() > 0 && getScore().getClass_id() > 0 && getScore().getType() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			ArrayList<Grading> gradings = new RefModel().getGradings(0);
			Grading g = null;
			if(gradings != null && gradings.size() > 0)
			{
				g = gradings.get(0);
			}
			
			if(g != null)
			{
				double test = g.getTest();
				double exam = g.getExam();
				
				boolean error = false;
				int errorCnt = 0;
				
				for(Score e : getScores())
				{
					e.setUser_id(user_id);
					e.setSub_id(getScore().getSub_id());
					e.setType(getScore().getType());
					
					boolean severe = false;
					
					if(getScore().getType().equalsIgnoreCase("t"))
					{
						if(e.getTest_score() > test)
						{
							severe = true;
						}
					}
					else if(getScore().getType().equalsIgnoreCase("e"))
					{
						if(e.getExam_score() > exam)
						{
							severe = true;
						}
					}
					
					if(severe)
					{
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("scores.severe.error", new Object[] {e.getStudent_fn() + " " + e.getStudent_mn() + " " + e.getStudent_ln() + " (" + e.getRollNumber() + ")"}), null));
					}
					else
					{
						int ret = tm.InsertScore(e);
						if(ret == 1)
						{
							error = true;
							errorCnt += 1;
						}
					}
				}
				
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("insert.success", new Object[] {"Scores"}), null));
				
				if(error)
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("insert.errors", new Object[] {errorCnt}), null));
				}
				
				setScores(null);
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("grading.notfound", null), null));
			}
		}
	}
	
	public void UpdateScores()
	{
		if(getScore().getSub_id() > 0 && getScore().getClass_id() > 0 && getScore().getType() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			ArrayList<Grading> gradings = new RefModel().getGradings(0);
			Grading g = null;
			if(gradings != null && gradings.size() > 0)
			{
				g = gradings.get(0);
			}
			
			if(g != null)
			{
				double test = g.getTest();
				double exam = g.getExam();
				
				boolean error = false;
				int errorCnt = 0;
				
				for(Score e : getScores2())
				{
					e.setSub_id(getScore().getSub_id());
					e.setUser_id(user_id);
					
					boolean severe = false;
					
					if(getScore().getType().equalsIgnoreCase("t"))
					{
						if(e.getTest_score() > test)
						{
							severe = true;
						}
					}
					else if(getScore().getType().equalsIgnoreCase("e"))
					{
						if(e.getExam_score() > exam)
						{
							severe = true;
						}
					}
					
					if(severe)
					{
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("scores.severe.error", new Object[] {e.getStudent_fn() + " " + e.getStudent_mn() + " " + e.getStudent_ln() + " (" + e.getRollNumber() + ")"}), null));
					}
					else
					{
						int ret = tm.UpdateScore(e);
						if(ret == 1)
						{
							error = true;
							errorCnt += 1;
						}
					}
				}
				
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.success", null), null));
				
				if(error)
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("insert.errors", new Object[] {errorCnt}), null));
				}
				
				setScores2(null);
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("grading.notfound", null), null));
			}
		}
	}
	
	public void GenerateResult()
	{
		if(getClass_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			Term term = null;
			
			term = appOptions.getCurrentTerm();
			/*ArrayList<Term> list = appOptions.getSessionTerms();
			for(Term t : list)
			{
				if(t.getTerm_end_dt() == null)
				{
					term = t;
					break;
				}
			}*/
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			
			ArrayList<Grading> gradings = new RefModel().getGradings(0);
			Grading grading = null;
			if(gradings != null && gradings.size() > 0)
			{
				grading = gradings.get(0);
			}
			// Grading grading = ((SettingsBean)curContext.getExternalContext().getSessionMap().get("settingsBean")).getGrading();
			
			TeacherModel tm = new TeacherModel();
			int ret = tm.GenerateClassTermResult(getClass_id(), term, user_id, grading);
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("insert.success", new Object[] {"Result generated and "}), null));
			
			if(ret > 0)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("insert.errors", new Object[] {ret}), null));
		}
	}
	
	public void ViewResults()
	{
		if(getClass_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			ArrayList<Term> list = appOptions.getSessionTerms();
			for(int i=0; i<getTerm_result_available().length; i++)
			{
				getTerm_result_available()[i] = tm.isTermResultAvailable(getClass_id(), list.get(i).getTerm_id());
			}
			
			setResults(tm.GetClassTermResult(getClass_id(), list));
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getResults().size()}), null));
		}
	}
	
	public void ViewResults2()
	{
		setResults(null);
		
		if(getStudent_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			TeacherModel tm = new TeacherModel();
			ArrayList<Term> list = appOptions.getSessionTerms();
			int class_id = 0;
			Ref e = new StudentModel().GetStudentSessionClass(getStudent_id(), 0);
			if(e != null)
				class_id = e.getId();
			for(int i=0; i<getTerm_result_available().length; i++)
			{
				getTerm_result_available()[i] = tm.isTermResultAvailable(class_id, list.get(i).getTerm_id());
			}
			
			Student st = null;
			
			AuthenticatorBean authB = (AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator");
			if(authB.getStudent() != null)
			{
				st = authB.getStudent();
			}
			else if(authB.getGuardian() != null)
			{
				ArrayList<Student> students = ((StudentBean)curContext.getExternalContext().getSessionMap().get("studentBean")).getGuardianStudents();
				for(Student s : students)
				{
					if(s.getStudent_id() == getStudent_id())
					{
						st = s;
						break;
					}
				}
			}
			
			setResults(tm.GetStudentTermResult(st, list));
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getResults().size()}), null));
		}
	}
	
	public String ViewReportCard()
	{
		return "reportcard";
	}
	
	

	public Attendance getAttendance()
	{
		if(attendance == null)
			attendance = new Attendance();
		return attendance;
	}

	public void setAttendance(Attendance attendance)
	{
		this.attendance = attendance;
	}

	public Attendance getSubjectAttendance()
	{
		if(subjectAttendance == null)
			subjectAttendance = new Attendance();
		return subjectAttendance;
	}

	public void setSubjectAttendance(Attendance subjectAttendance)
	{
		this.subjectAttendance = subjectAttendance;
	}

	public ArrayList<Attendance> getClassStudents()
	{
		if(getAttendance().getClass_id() > 0 && getAttendance().getDate() != null)
		{
			if(classStudents == null)
				classStudents = new StudentModel().GetClassStudents(getAttendance().getClass_id(), 0);
		}
		else
		{
			if(classStudents == null)
				classStudents = new ArrayList<Attendance>();
			
			classStudents.clear();
		}
		
		return classStudents;
	}

	public void setClassStudents(ArrayList<Attendance> classStudents)
	{
		this.classStudents = classStudents;
	}

	public ArrayList<Attendance> getClassStudents2()
	{
		if(getAttendance().getClass_id() > 0 && getAttendance().getDate() != null)
		{
			if(classStudents2 == null)
				classStudents2 = new TeacherModel().GetClassAttendance(getAttendance().getClass_id(), getAttendance().getDate());
		}
		else
		{
			if(classStudents2 == null)
				classStudents2 = new ArrayList<Attendance>();
			
			classStudents2.clear();
		}
		
		return classStudents2;
	}

	public void setClassStudents2(ArrayList<Attendance> classStudents2)
	{
		this.classStudents2 = classStudents2;
	}

	public ArrayList<Attendance> getClassSubjectStudents()
	{
		if(getSubjectAttendance().getClass_id() > 0 && getSubjectAttendance().getDate() != null)
		{
			if(classSubjectStudents == null)
				classSubjectStudents = new StudentModel().GetClassStudents(getSubjectAttendance().getClass_id(), 0);
		}
		else
		{
			if(classSubjectStudents == null)
				classSubjectStudents = new ArrayList<Attendance>();
			
			classSubjectStudents.clear();
		}
		
		return classSubjectStudents;
	}

	public void setClassSubjectStudents(ArrayList<Attendance> classSubjectStudents)
	{
		this.classSubjectStudents = classSubjectStudents;
	}

	public ArrayList<Attendance> getClassSubjectStudents2()
	{
		if(getSubjectAttendance().getClass_id() > 0 && getSubjectAttendance().getDate() != null)
		{
			if(classSubjectStudents2 == null)
				classSubjectStudents2 = new StudentModel().GetClassStudents(getSubjectAttendance().getClass_id(), 0);
		}
		else
		{
			if(classSubjectStudents2 == null)
				classSubjectStudents2 = new ArrayList<Attendance>();
			
			classSubjectStudents2.clear();
		}
		
		return classSubjectStudents2;
	}

	public void setClassSubjectStudents2(ArrayList<Attendance> classSubjectStudents2)
	{
		this.classSubjectStudents2 = classSubjectStudents2;
	}

	public Score getScore()
	{
		if(score == null)
			score = new Score();
		return score;
	}

	public void setScore(Score score)
	{
		this.score = score;
	}

	public ArrayList<Score> getScores()
	{
		if(getScore().getClass_id() > 0)
		{
			if(scores == null)
				scores = new TeacherModel().GetClassStudentsAsScore(getScore().getClass_id());
		}
		else
		{
			if(scores == null)
				scores = new ArrayList<Score>();
			
			scores.clear();
		}
		return scores;
	}

	public void setScores(ArrayList<Score> scores)
	{
		this.scores = scores;
	}

	public ArrayList<Score> getScores2()
	{
		if(getScore().getClass_id() > 0)
		{
			if(scores2 == null)
				scores2 = new TeacherModel().GetClassStudentsAndScores(getScore().getClass_id(), getScore().getSub_id(), 0);
		}
		else
		{
			if(scores2 == null)
				scores2 = new ArrayList<Score>();
			
			scores2.clear();
		}
		return scores2;
	}

	public void setScores2(ArrayList<Score> scores2)
	{
		this.scores2 = scores2;
	}

	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int class_id)
	{
		this.class_id = class_id;
	}

	public ArrayList<Result> getResults()
	{
		if(results == null)
			results = new ArrayList<Result>();
		return results;
	}

	public void setResults(ArrayList<Result> results)
	{
		this.results = results;
	}
	
	public Result getResult() {
		if(result == null)
			result = new Result();
		return result;
	}
	
	public void setResult(Result result) {
		this.result = result;
	}
	
	public TermResult getTermResult() {
		if(termResult == null)
			termResult = new TermResult();
		return termResult;
	}
	
	public void setTermResult(TermResult termResult) {
		this.termResult = termResult;
	}
	
	public boolean[] getTerm_result_available() {
		if(term_result_available == null)
		{
			term_result_available = new boolean[appOptions.getSessionTerms().size()];
			for(int i=0; i<term_result_available.length; i++)
			{
				term_result_available[i] = false;
			}
		}
		return term_result_available;
	}
	
	public void setTerm_result_available(boolean[] term_result_available) {
		this.term_result_available = term_result_available;
	}

	public int getStudent_id() {
		return student_id;
	}

	public void setStudent_id(int student_id) {
		this.student_id = student_id;
	}

	public int getSubject_id() {
		return subject_id;
	}

	public void setSubject_id(int subject_id) {
		this.subject_id = subject_id;
	}

	public Date getDate1() {
		return date1;
	}

	public void setDate1(Date date1) {
		this.date1 = date1;
	}

	public Date getDate2() {
		return date2;
	}

	public void setDate2(Date date2) {
		this.date2 = date2;
	}

	public ArrayList<Attendance> getStudentClassAttendance() {
		if(getStudent_id() > 0 && getDate1() != null && getDate2() != null)
		{
			studentClassAttendance = new TeacherModel().GetStudentClassAttendance(getStudent_id(), getDate1(), getDate2());
		}
		else
		{
			if(studentClassAttendance == null)
				studentClassAttendance = new ArrayList<Attendance>();
			
			studentClassAttendance.clear();
		}
		
		return studentClassAttendance;
	}

	public void setStudentClassAttendance(
			ArrayList<Attendance> studentClassAttendance) {
		this.studentClassAttendance = studentClassAttendance;
	}

	public ArrayList<Attendance> getStudentSubjectAttendance() {
		if(getStudent_id() > 0 && getSubject_id() > 0 && getDate1() != null && getDate2() != null)
		{
			studentSubjectAttendance = new TeacherModel().GetStudentSubjectAttendance(getStudent_id(), getSubject_id(), getDate1(), getDate2());
		}
		else
		{
			if(studentSubjectAttendance == null)
				studentSubjectAttendance = new ArrayList<Attendance>();
			
			studentSubjectAttendance.clear();
		}
		return studentSubjectAttendance;
	}

	public void setStudentSubjectAttendance(
			ArrayList<Attendance> studentSubjectAttendance) {
		this.studentSubjectAttendance = studentSubjectAttendance;
	}
	
}
