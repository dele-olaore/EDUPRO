package com.dexter.bradawl.dto;

import org.hibernate.validator.Email;
import org.hibernate.validator.NotEmpty;

public class Address implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int addr_id;
	private String addr1;
	private String addr2;
	private String phone1;
	private String phone2;
	private String email;
	private String fax;
	private String website;

	public Address()
	{}

	public int getAddr_id()
	{
		return addr_id;
	}

	public void setAddr_id(int addrId)
	{
		addr_id = addrId;
	}

	@NotEmpty
	public String getAddr1()
	{
		return addr1;
	}

	public void setAddr1(String addr1)
	{
		this.addr1 = addr1;
	}

	public String getAddr2()
	{
		return addr2;
	}

	public void setAddr2(String addr2)
	{
		this.addr2 = addr2;
	}

	public String getPhone1()
	{
		return phone1;
	}

	public void setPhone1(String phone1)
	{
		this.phone1 = phone1;
	}

	public String getPhone2()
	{
		return phone2;
	}

	public void setPhone2(String phone2)
	{
		this.phone2 = phone2;
	}

	@Email
	public String getEmail()
	{
		return email;
	}

	public void setEmail(String email)
	{
		this.email = email;
	}

	public String getFax()
	{
		return fax;
	}

	public void setFax(String fax)
	{
		this.fax = fax;
	}

	public String getWebsite()
	{
		return website;
	}

	public void setWebsite(String website)
	{
		this.website = website;
	}

	public static long getSerialversionuid()
	{
		return serialVersionUID;
	}
	
}