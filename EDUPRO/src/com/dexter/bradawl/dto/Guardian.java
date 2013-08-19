package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.RefModel;

public class Guardian
{
	private int guardian_id;
	private int title_id;
	private String title_nm;
	private String name;
	private boolean hasUser;
	private String email;
	private int user_id;
	private Date crt_dt;
	
	private int relationship_id;
	private String relationship_nm;
	
	private int status_id;
	
	private Address address;
	
	private User user;
	
	public Guardian()
	{}

	public int getGuardian_id()
	{
		return guardian_id;
	}

	public void setGuardian_id(int guardian_id)
	{
		this.guardian_id = guardian_id;
	}

	public int getTitle_id()
	{
		return title_id;
	}

	public void setTitle_id(int title_id)
	{
		if(title_id > 0)
		{
			ArrayList<Ref> list = new RefModel().getRefObjects(6);
			for(Ref e : list)
			{
				if(e.getId() == title_id)
				{
					setTitle_nm(e.getName());
					break;
				}
			}
		}
		this.title_id = title_id;
	}

	public String getTitle_nm()
	{
		return title_nm;
	}

	public void setTitle_nm(String title_nm)
	{
		this.title_nm = title_nm;
	}

	public String getName()
	{
		return name;
	}

	public void setName(String name)
	{
		this.name = name;
	}

	public boolean getHasUser() {
		return hasUser;
	}

	public void setHasUser(boolean hasUser) {
		this.hasUser = hasUser;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int user_id)
	{
		this.user_id = user_id;
	}

	public Date getCrt_dt()
	{
		return crt_dt;
	}

	public void setCrt_dt(Date crt_dt)
	{
		this.crt_dt = crt_dt;
	}

	public int getRelationship_id()
	{
		return relationship_id;
	}

	public void setRelationship_id(int relationship_id)
	{
		if(relationship_id > 0)
		{
			ArrayList<Ref> list = new RefModel().getRefObjects(7);
			for(Ref e : list)
			{
				if(e.getId() == relationship_id)
				{
					setRelationship_nm(e.getName());
					break;
				}
			}
		}
		this.relationship_id = relationship_id;
	}

	public String getRelationship_nm()
	{
		return relationship_nm;
	}

	public void setRelationship_nm(String relationship_nm)
	{
		this.relationship_nm = relationship_nm;
	}

	public int getStatus_id() {
		return status_id;
	}

	public void setStatus_id(int status_id) {
		this.status_id = status_id;
	}

	public Address getAddress()
	{
		if(address == null)
			address = new Address();
		return address;
	}

	public void setAddress(Address address)
	{
		this.address = address;
	}

	public User getUser() {
		if(user == null)
			user = new User();
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}
	
}
