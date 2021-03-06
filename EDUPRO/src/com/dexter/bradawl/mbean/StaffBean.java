package com.dexter.bradawl.mbean;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.ArrayList;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.captcha.Captcha;
import org.jboss.seam.log.Log;
import org.richfaces.event.UploadEvent;
import org.richfaces.model.UploadItem;

import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.model.StaffModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("staffBean")
@Scope(ScopeType.SESSION)
public class StaffBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@Logger
	private Log log;
	
	@In
	AppOptions appOptions;
	
	private ArrayList<Ref> departments;
	private Ref department;
	
	private Staff staff, viewingStaff;
	private ArrayList<Staff> staffs;
	private UploadItem uploadItem;
	
	/**
	 * Creates a new staff.
	 * */
	public void CreateNewStaff()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Creating a staff...");
		
		Staff s = getStaff();
		int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
		s.setUser_id(user_id);
		s.setStatus_id(1);
		
		if(s.getHasUser())
		{
			if(!s.getEmail().equalsIgnoreCase(s.getAddress().getEmail()))
			{
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("staff.email.notconfirmed", null), null));
				
				return;
			}
		}
		
		int ret = new StaffModel().CreateStaff(s);
		switch(ret)
		{
			case 0:
			{
				log.info("Staff created successfully");
				// Copying the files into the disk using the new id
				boolean savesuccess = false;
				try
				{
					if(getUploadItem() != null)
					{
						log.info("Saving staff photo...");
						
						java.io.File tempFile = getUploadItem().getFile();
						Utils.copyFile(new FileInputStream(tempFile), new FileOutputStream(appOptions.getFileSavePath() + "/staffs/"+ s.getStaff_id()));
						savesuccess = true;
						
						log.info("Done");
					}
				}
				catch(Exception ex)
				{
					log.fatal("Error saving staff photo: " + ex.getMessage());
				}
				
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("user.created.details", new Object[]{s.getUser().getUsername(), "password"}), null));
				if(!savesuccess && getUploadItem() != null)
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("photo.upload.error", null), null));
				
				reset();
				
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
		setUploadItem(item); // store the uploaded item, until staff is SAVED
	}
	
	public void UpdateStaff()
	{
		if(getViewingStaff().getStaff_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Updating staff...");
			
			Staff s = getViewingStaff();
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			s.setUser_id(user_id);
			
			int ret = new StaffModel().UpdateStaff(s);
			switch(ret)
			{
				case 0:
				{
					log.info("Staff updated successfully");
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("update.success", null), null));
					
					if(getUploadItem() != null)
					{
						java.io.File tempFile = getUploadItem().getFile();
						try {
							Utils.copyFile(new FileInputStream(tempFile), new FileOutputStream(appOptions.getFileSavePath() + "/staffs/"+ s.getStaff_id()));
						} catch (FileNotFoundException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						} catch (IOException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
					}
					
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
	
	/**
	 * Views staffs
	 * */
	public void ViewStaffs()
	{
		setViewingStaff(null);
		
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		log.info("Staffs search...");
		setStaffs(new StaffModel().getStaffs(getStaff().getStaff_cat_id(), getStaff().getDepartment_id(), getStaff().getStatus_id(), getStaff().getStaff_fn(), getStaff().getStaff_ln()));
		if(getStaffs().size() > 0)
		{
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getStaffs().size()}), null));
			log.info("Size: " + getStaffs().size());
		}
		else
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
		
		Captcha.instance().setResponse(null);
		Captcha.instance().init();
	}
	
	public void ViewStaff()
	{
		if(getViewingStaff() != null && getViewingStaff().getStaff_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Viewing staff: " + getViewingStaff().getStaff_fn() + " " + getViewingStaff().getStaff_ln() + "...");
			
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("student.viewing", new Object[] {getViewingStaff().getStaff_fn() + " " + getViewingStaff().getStaff_ln()}), null));
		}
	}
	
	/**
	 * Creates a new department.
	 * */
	public void CreateDepartment()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Creating a department");
		
		int ret = new RefModel().CUDepartment(getDepartment(), false);
		
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
	 * Updates a department
	 * */
	public void UpdateDepartment()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Updating a department");
		
		int ret = new RefModel().CUDepartment(getDepartment(), true);
		
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
	
	public void reset()
	{
		setDepartment(null);
		setStaff(null);
		setUploadItem(null);
	}
	
	public ArrayList<Ref> getDepartments()
	{
		departments = new RefModel().getRefObjects(1);
		
		return departments;
	}
	
	public void setDepartments(ArrayList<Ref> departments)
	{
		this.departments = departments;
	}
	
	public Ref getDepartment()
	{
		if(department == null)
		{
			department = new Ref();
		}
		
		return department;
	}
	
	public void setDepartment(Ref department)
	{
		this.department = department;
	}

	public Staff getStaff()
	{
		if(staff == null)
			staff = new Staff();
		
		return staff;
	}

	public void setStaff(Staff staff)
	{
		this.staff = staff;
	}

	public Staff getViewingStaff()
	{
		if(viewingStaff == null)
			viewingStaff = new Staff();
		return viewingStaff;
	}

	public void setViewingStaff(Staff viewingStaff)
	{
		this.viewingStaff = viewingStaff;
	}

	public UploadItem getUploadItem()
	{
		return uploadItem;
	}

	public void setUploadItem(UploadItem uploadItem)
	{
		this.uploadItem = uploadItem;
	}

	public ArrayList<Staff> getStaffs()
	{
		if(staffs == null)
			staffs = new ArrayList<Staff>();
		return staffs;
	}

	public void setStaffs(ArrayList<Staff> staffs)
	{
		this.staffs = staffs;
	}
	
}
