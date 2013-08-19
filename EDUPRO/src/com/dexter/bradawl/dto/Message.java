package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

public class Message
{
	private int id;
	private String subject;
	private String body;
	private Date sent_dt;
	private int sender_id;
	private String sender_nm;
	private String username;
	private int sent_id;
	private int status;
	
	private String reply_body;
	
	private ArrayList<To> to;
	
	public Message()
	{}

	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}

	public String getSubject()
	{
		return subject;
	}

	public void setSubject(String subject)
	{
		this.subject = subject;
	}

	public String getBody()
	{
		return body;
	}

	public void setBody(String body)
	{
		this.body = body;
	}

	public Date getSent_dt()
	{
		return sent_dt;
	}

	public void setSent_dt(Date sent_dt)
	{
		this.sent_dt = sent_dt;
	}

	public int getSender_id()
	{
		return sender_id;
	}

	public void setSender_id(int sender_id)
	{
		this.sender_id = sender_id;
	}

	public String getSender_nm()
	{
		return sender_nm;
	}

	public void setSender_nm(String sender_nm)
	{
		this.sender_nm = sender_nm;
	}

	public String getUsername()
	{
		return username;
	}

	public void setUsername(String username)
	{
		this.username = username;
	}

	public int getSent_id()
	{
		return sent_id;
	}

	public void setSent_id(int sent_id)
	{
		this.sent_id = sent_id;
	}

	public int getStatus()
	{
		return status;
	}

	public void setStatus(int status)
	{
		this.status = status;
	}

	public String getReply_body()
	{
		return reply_body;
	}

	public void setReply_body(String reply_body)
	{
		this.reply_body = reply_body;
	}

	public ArrayList<To> getTo()
	{
		if(to == null)
			to = new ArrayList<To>();
		return to;
	}

	public void setTo(ArrayList<To> to)
	{
		this.to = to;
	}
	
}
