package com.dexter.bradawl.dto;

import java.util.ArrayList;

import com.dexter.bradawl.model.BursaryModel;
import com.dexter.bradawl.model.RefModel;

public class ClassFee
{
	private int class_id;
	private int fee_cat_id;
	private String fee_cat_nm;
	private int user_id;
	private ArrayList<Fee> fees;
	
	public ClassFee()
	{}

	public int getClass_id()
	{
		return class_id;
	}

	public void setClass_id(int class_id)
	{
		this.class_id = class_id;
	}

	public int getFee_cat_id()
	{
		return fee_cat_id;
	}

	public void setFee_cat_id(int fee_cat_id)
	{
		if(fee_cat_id > 0)
		{
			ArrayList<Ref> list = new RefModel().getRefObjects(5);
			for(Ref e : list)
			{
				if(e.getId() == fee_cat_id)
				{
					setFee_cat_nm(e.getName());
					break;
				}
			}
		}
		this.fee_cat_id = fee_cat_id;
	}

	public String getFee_cat_nm()
	{
		return fee_cat_nm;
	}

	public void setFee_cat_nm(String fee_cat_nm)
	{
		this.fee_cat_nm = fee_cat_nm;
	}

	public ArrayList<Fee> getFees()
	{
		fees = new BursaryModel().GetFeeByCat(fee_cat_id);
		
		return fees;
	}

	public void setFees(ArrayList<Fee> fees)
	{
		this.fees = fees;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int user_id)
	{
		this.user_id = user_id;
	}
	
}
