package com.dexter.bradawl.mbean;

import java.util.ArrayList;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.Map;
import java.util.Random;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.AutoCreate;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.log.Log;

import com.dexter.bradawl.dto.Guardian;
import com.dexter.bradawl.dto.PasswordQuestion;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.User;
import com.dexter.bradawl.model.AuthenticatorModel;
import com.dexter.bradawl.model.DashboardModel;
import com.dexter.bradawl.model.OptionModel;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.StaffModel;
import com.dexter.bradawl.model.StudentModel;
import com.dexter.bradawl.model.UserModel;
import com.dexter.bradawl.security.Encrypter;
import com.dexter.bradawl.util.UserOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("authenticator")
@Scope(ScopeType.SESSION)
@AutoCreate
public class AuthenticatorBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private String username;
	private String user_password;
	
	private String user_password2;
	private String new_password;
	private String cnew_password;
	
	private User user;
	private Staff staff;
	private Student student;
	private Guardian guardian;
	
	@In(create=true)
	UserOptions userOptions;
	
	@Logger
	private Log log;
	
	private ArrayList<Ref> modules;
	private Hashtable<Integer, ArrayList<Ref>> functions;
	
	private ArrayList<PasswordQuestion> passwordQuestions;
	private PasswordQuestion passwordQuestion;
	private String answer;
	
	public String authenticate()
	{
		String ret = "index";
		
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		String user_password_ecypt = Encrypter.Encrypt(user_password);
		
		UserModel uModel = new UserModel();
		StaffModel stModel = new StaffModel();
		StudentModel stuModel = new StudentModel();
		
		user = uModel.getUserByUsername(username);
		
		if(user != null && user_password_ecypt.equals(user.getUser_password()))
		{
			log.info("User {0} signed in", username);
			// Now get the staff or student or guardian object for the current user
			
			if(user.getRole_id() == 8) // user is a student
			{
				student = stuModel.getStudentByID(user.getStudent_id());
			}
			else if(user.getRole_id() == 9) // user id a guardian
			{
				guardian = stuModel.getGuardian(user.getGuardian_id());
			}
			else
			{
				staff = stModel.getStaffByID(user.getStaff_id());
				if(staff.getStatus_id() != 1)
				{
					log.info("Staff {0}'s account is not active", staff.getStaff_fn() + " " + staff.getStaff_ln());
					
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("account.notactive", null), null));
					
					setUser(null);
					setStaff(null);
					
					return ret;
				}
			}
			
			String[] options = new OptionModel().getUserOptions(user.getUser_id());
			if(options != null)
			{
				userOptions.setSkin(options[0]);
			}
			
			ArrayList<Ref> roles = new RefModel().getRefObjects(3);
			for(Ref e : roles)
			{
				if(e.getId() == user.getRole_id())
				{
					user.setRole_nm(e.getName());
					break;
				}
			}
			
			ret = Dashboard();
		}
		else
		{
			log.info("User {0} failed authentication", username);
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("org.jboss.seam.loginFailed", null), null));
		}
		
		return ret;
	}
	
	public String Dashboard()
	{
		String ret = "dashboard";
		
		// here we load the modules and functions for the current role
		DashboardModel dm = new DashboardModel();
		
		ArrayList<Ref> modules = dm.GetRoleModules(user.getRole_id());
		ArrayList<Ref> myModules = new ArrayList<Ref>();
		
		for(Ref mod : modules)
		{
			if(mod.getName().equalsIgnoreCase("my classes")) // here, the staff must have at least one class mapped to him/her before they can see this module
			{
				if(new RefModel().getStaffClasses(user.getStaff_id()).size() > 0)
					myModules.add(mod);
			}
			else if(mod.getName().equalsIgnoreCase("my subjects")) // here, the staff must have at least one subject mapped to him/her
			{
				if(new StaffModel().GetStaffSubjects(user.getStaff_id()).size() > 0)
					myModules.add(mod);
			}
			else
			{
				myModules.add(mod);
			}
		}
		
		setModules(myModules);
		for(Ref m : getModules())
		{
			ArrayList<Ref> functions = dm.GetRoleFunctionsByModule(user.getRole_id(), m.getId());
			getFunctions().put(m.getId(), functions);
		}
		
		return ret;
	}
	
	public void ChangePassword()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		if(getUser() != null && getUser().getUser_id() > 0)
		{
			if(getUser_password().equals(getUser_password2()))
			{
				if(getNew_password().trim().length() > 0)
				{
					if(getNew_password().equals(getCnew_password()))
					{
						setNew_password(Encrypter.Encrypt(getNew_password()));
						
						boolean ret = new AuthenticatorModel().ChangePassword(getUser().getUser_id(), getNew_password());
						if(ret)
						{
							setUser_password(getCnew_password());
							setUser_password2(null);
							setNew_password(null);
							setCnew_password(null);
							curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("user.password.changed", null), null));
						}
						else
						{
							curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("user.password.notchanged", null), null));
						}
					}
					else
					{
						curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("user.password.notthesame", null), null));
					}
				}
				else
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("org.jboss.seam.loginFailed", null), null));
				}
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("org.jboss.seam.loginFailed", null), null));
			}
		}
		else
		{
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("org.jboss.seam.NotLoggedIn", null), null));
		}
	}
	
	/**
	 * Create password reset questions.
	 * */
	public void CreatePasswordResetQuestion()
	{
		if(getPasswordQuestion() != null && getPasswordQuestion().getQuestion() != null && getPasswordQuestion().getAnswer() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			getPasswordQuestion().setUser_id(getUser().getUser_id());
			
			int ret = new AuthenticatorModel().CreatePasswordQuestion(getPasswordQuestion(), 1); // create type
			
			switch(ret)
			{
			case 0:
			{
				setPasswordQuestion(null);
				setPasswordQuestions(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				
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
	
	/**
	 * Deletes a password reset question.
	 * */
	public void DeletePasswordResetQuestion()
	{
		if(getPasswordQuestion() != null && getPasswordQuestion().getId() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			int ret = new AuthenticatorModel().CreatePasswordQuestion(getPasswordQuestion(), 2); // delete type
			
			switch(ret)
			{
			case 0:
			{
				setPasswordQuestion(null);
				setPasswordQuestions(null);
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("remove.success", null), null));
				
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
	
	/**
	 * Signs out a user.
	 * */
	public String signOut()
	{
		String ret = "logout";
		
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("org.jboss.seam.logout", null), null));
		
		setUser(null);
		setStaff(null);
		setStudent(null);
		
		setUsername(null);
		setUser_password(null);
		
		userOptions.setSkin(null);
		
		Map<String, Object> sessionMap = curContext.getExternalContext().getSessionMap();
		
		Iterator<String> sessItr = sessionMap.keySet().iterator();
		while(sessItr.hasNext())
		{
			String nm = sessItr.next();
			//if(!nm.equalsIgnoreCase("authenticator"))
			//{
				sessionMap.put(nm, null);
				sessionMap.remove(nm);
			//}
		}
		
		sessionMap.clear();
		
		org.jboss.seam.web.Session.getInstance().invalidate();
		
		return ret;
	}

	public String getUsername()
	{
		return username;
	}

	public void setUsername(String username)
	{
		this.username = username;
	}

	public String getUser_password()
	{
		return user_password;
	}

	public void setUser_password(String user_password)
	{
		this.user_password = user_password;
	}

	public String getUser_password2() {
		return user_password2;
	}

	public void setUser_password2(String user_password2) {
		this.user_password2 = user_password2;
	}

	public String getNew_password() {
		return new_password;
	}

	public void setNew_password(String new_password) {
		this.new_password = new_password;
	}

	public String getCnew_password() {
		return cnew_password;
	}

	public void setCnew_password(String cnew_password) {
		this.cnew_password = cnew_password;
	}

	public User getUser()
	{
		return user;
	}

	public void setUser(User user)
	{
		this.user = user;
	}

	public Staff getStaff()
	{
		return staff;
	}

	public void setStaff(Staff staff)
	{
		this.staff = staff;
	}

	public Student getStudent()
	{
		return student;
	}

	public void setStudent(Student student)
	{
		this.student = student;
	}

	public Guardian getGuardian() {
		return guardian;
	}

	public void setGuardian(Guardian guardian) {
		this.guardian = guardian;
	}

	public ArrayList<Ref> getModules()
	{
		if(modules == null)
			modules = new ArrayList<Ref>();
		return modules;
	}

	public void setModules(ArrayList<Ref> modules)
	{
		this.modules = modules;
	}

	public Hashtable<Integer, ArrayList<Ref>> getFunctions()
	{
		if(functions == null)
			functions = new Hashtable<Integer, ArrayList<Ref>>();
		
		return functions;
	}

	public void setFunctions(Hashtable<Integer, ArrayList<Ref>> functions)
	{
		this.functions = functions;
	}

	public ArrayList<PasswordQuestion> getPasswordQuestions() {
		if(passwordQuestions == null)
		{
			passwordQuestions = new AuthenticatorModel().GetUserPasswordQuestions(getUser().getUser_id());
		}
		return passwordQuestions;
	}
	
	private PasswordQuestion resetQuestion;
	private User otherUser;
	
	public PasswordQuestion getResetQuestion()
	{
		if(resetQuestion == null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			if(getUsername() != null)
			{
				otherUser = new UserModel().getUserByUsername(getUsername());
				
				if(otherUser != null)
				{
					ArrayList<PasswordQuestion> list = new AuthenticatorModel().GetUserPasswordQuestions(otherUser.getUser_id());
					int size = list.size();
					int pos = new Random().nextInt(size);
					
					resetQuestion = list.get(pos);
				}
				else
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("org.jboss.seam.loginFailed", null), null));
				}
			}
		}
		return resetQuestion;
	}
	
	public void setResetQuestion(PasswordQuestion resetQuestion)
	{
		this.resetQuestion = resetQuestion;
	}
	
	private String[] letters = new String[] {"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"};
	public void ResetPassword()
	{
		if(resetQuestion != null && otherUser != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			
			if(resetQuestion.getAnswer().equals(getAnswer()))
			{
				String ramPass = "";
				
				for(int i=0; i<8; i++)
				{
					Random ran = new Random();
					String l = letters[ran.nextInt(letters.length)];
					ramPass = ramPass + l;
				}
				
				String ramPass2 = Encrypter.Encrypt(ramPass);
				
				boolean ret = new AuthenticatorModel().ChangePassword(otherUser.getUser_id(), ramPass2);
				if(ret)
				{
					setAnswer(null);
					setResetQuestion(null);
					otherUser = null;
					setUsername(null);
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("user.password.reset.success", new Object[]{ramPass}), null));
				}
				else
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("user.password.reset.failed", null), null));
				}
			}
			else
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("reset.answer.invalid", null), null));
			}
		}
	}

	public void setPasswordQuestions(ArrayList<PasswordQuestion> passwordQuestions) {
		this.passwordQuestions = passwordQuestions;
	}

	public PasswordQuestion getPasswordQuestion() {
		if(passwordQuestion == null)
			passwordQuestion = new PasswordQuestion();
		return passwordQuestion;
	}

	public void setPasswordQuestion(PasswordQuestion passwordQuestion) {
		this.passwordQuestion = passwordQuestion;
	}

	public String getAnswer() {
		return answer;
	}

	public void setAnswer(String answer) {
		this.answer = answer;
	}
	
}
