package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

public class Ref implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int id;
	private String name;
	private String desc;
	
	// for functions
	private String mod_name;
	private String func_page;
	private String func_button;
	private String isAction;
	
	// for any other that requires type
	private String type;
	
	// for any other that requires ids
	private int id2;
	private String name2;
	private int id3;
	private String name3;
	
	// for news
	private String news_headline;
	private String news_body;
	private int user_id;
	private ArrayList<NewsComment> newsComments;
	
	private int count;
	
	// for events
	private String title;
	private String body;
	private Date date;
	
	private Date date_created;
	
	public Ref()
	{}

	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}

	public String getName()
	{
		return name;
	}

	public void setName(String name)
	{
		this.name = name;
	}

	public String getDesc()
	{
		return desc;
	}

	public void setDesc(String desc)
	{
		this.desc = desc;
	}

	public String getMod_name()
	{
		return mod_name;
	}

	public void setMod_name(String mod_name)
	{
		this.mod_name = mod_name;
	}

	public String getFunc_page()
	{
		return func_page;
	}

	public void setFunc_page(String func_page)
	{
		this.func_page = func_page;
	}

	public String getFunc_button()
	{
		return func_button;
	}

	public void setFunc_button(String func_button)
	{
		this.func_button = func_button;
	}

	public String getIsAction()
	{
		return isAction;
	}

	public void setIsAction(String isAction)
	{
		this.isAction = isAction;
	}

	public String getType()
	{
		return type;
	}

	public void setType(String type)
	{
		this.type = type;
	}

	public int getId2()
	{
		return id2;
	}

	public void setId2(int id2)
	{
		this.id2 = id2;
	}

	public int getId3()
	{
		return id3;
	}

	public void setId3(int id3)
	{
		this.id3 = id3;
	}

	public String getName2()
	{
		return name2;
	}

	public void setName2(String name2)
	{
		this.name2 = name2;
	}

	public String getName3()
	{
		return name3;
	}

	public void setName3(String name3)
	{
		this.name3 = name3;
	}

	public String getNews_headline()
	{
		return news_headline;
	}

	public void setNews_headline(String news_headline)
	{
		this.news_headline = news_headline;
	}

	public String getNews_body()
	{
		return news_body;
	}

	public void setNews_body(String news_body)
	{
		this.news_body = news_body;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int user_id)
	{
		this.user_id = user_id;
	}

	public String getTitle()
	{
		return title;
	}

	public void setTitle(String title)
	{
		this.title = title;
	}

	public String getBody()
	{
		return body;
	}

	public void setBody(String body)
	{
		this.body = body;
	}

	public Date getDate()
	{
		return date;
	}

	public void setDate(Date date)
	{
		this.date = date;
	}

	public int getCount()
	{
		return count;
	}

	public void setCount(int count)
	{
		this.count = count;
	}

	public Date getDate_created()
	{
		return date_created;
	}

	public void setDate_created(Date date_created)
	{
		this.date_created = date_created;
	}

	public ArrayList<NewsComment> getNewsComments()
	{
		if(newsComments == null)
			newsComments = new ArrayList<NewsComment>();
		return newsComments;
	}

	public void setNewsComments(ArrayList<NewsComment> newsComments)
	{
		this.newsComments = newsComments;
	}
	
}
