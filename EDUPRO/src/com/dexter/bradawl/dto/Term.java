package com.dexter.bradawl.dto;

import java.util.Date;

public class Term implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int term_id;
	private String term_nm;
	private int session_id;
	private Date term_st_dt;
	private Date term_end_dt;
	private Date crt_dt;
	
	public Term()
	{}

	public int getTerm_id()
	{
		return term_id;
	}

	public void setTerm_id(int termId)
	{
		term_id = termId;
	}

	public String getTerm_nm()
	{
		return term_nm;
	}

	public void setTerm_nm(String termNm)
	{
		term_nm = termNm;
	}

	public int getSession_id()
	{
		return session_id;
	}

	public void setSession_id(int sessionId)
	{
		session_id = sessionId;
	}

	public Date getTerm_st_dt()
	{
		return term_st_dt;
	}

	public void setTerm_st_dt(Date termStDt)
	{
		term_st_dt = termStDt;
	}

	public Date getTerm_end_dt()
	{
		return term_end_dt;
	}

	public void setTerm_end_dt(Date termEndDt)
	{
		term_end_dt = termEndDt;
	}

	public Date getCrt_dt()
	{
		return crt_dt;
	}

	public void setCrt_dt(Date crtDt)
	{
		crt_dt = crtDt;
	}
	
}
