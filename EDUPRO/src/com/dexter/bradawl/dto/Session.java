package com.dexter.bradawl.dto;

import java.util.Date;

public class Session implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int session_id;
	private String session_nm;
	private Date session_st_dt;
	
	public Session()
	{}

	public int getSession_id()
	{
		return session_id;
	}

	public void setSession_id(int sessionId)
	{
		session_id = sessionId;
	}

	public String getSession_nm()
	{
		return session_nm;
	}

	public void setSession_nm(String sessionNm)
	{
		session_nm = sessionNm;
	}

	public Date getSession_st_dt()
	{
		return session_st_dt;
	}

	public void setSession_st_dt(Date sessionStDt)
	{
		session_st_dt = sessionStDt;
	}
	
}
