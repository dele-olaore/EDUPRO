package com.dexter.bradawl.dto;

public class EntityMap implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int id;
	private int first_id;
	private int second_id;
	private int third_id;
	
	public EntityMap()
	{}

	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}

	public int getFirst_id()
	{
		return first_id;
	}

	public void setFirst_id(int first_id)
	{
		this.first_id = first_id;
	}

	public int getSecond_id()
	{
		return second_id;
	}

	public void setSecond_id(int second_id)
	{
		this.second_id = second_id;
	}

	public int getThird_id()
	{
		return third_id;
	}

	public void setThird_id(int third_id)
	{
		this.third_id = third_id;
	}

	public static long getSerialversionuid()
	{
		return serialVersionUID;
	}

	
}
