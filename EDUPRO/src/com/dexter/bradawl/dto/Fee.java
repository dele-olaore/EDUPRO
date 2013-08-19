package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.BursaryModel;

public class Fee implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int fee_id;
	private int fee_cat_id;
	private String fee_cat_nm;
	private String fee_cat_desc;
	private String fee_nm;
	private String fee_desc;
	private int user_id;
	private Date crt_dt;

	// for fee payments
	private double amount;
	private double balance;
	
	public Fee()
	{}

	public int getFee_id()
	{
		return fee_id;
	}

	public void setFee_id(int feeId)
	{
		fee_id = feeId;
	}

	public int getFee_cat_id()
	{
		return fee_cat_id;
	}

	public void setFee_cat_id(int feeCatId)
	{
		if(feeCatId > 0)
		{
			ArrayList<Ref> list = new BursaryModel().GetFeeCategories();
			for(Ref e : list)
			{
				if(e.getId() == feeCatId)
				{
					setFee_cat_nm(e.getName());
					setFee_cat_desc(e.getDesc());
					break;
				}
			}
		}
		fee_cat_id = feeCatId;
	}

	public String getFee_cat_nm()
	{
		return fee_cat_nm;
	}

	public void setFee_cat_nm(String fee_cat_nm)
	{
		this.fee_cat_nm = fee_cat_nm;
	}

	public String getFee_cat_desc()
	{
		return fee_cat_desc;
	}

	public void setFee_cat_desc(String fee_cat_desc)
	{
		this.fee_cat_desc = fee_cat_desc;
	}

	public String getFee_nm()
	{
		return fee_nm;
	}

	public void setFee_nm(String feeNm)
	{
		fee_nm = feeNm;
	}

	public String getFee_desc()
	{
		return fee_desc;
	}

	public void setFee_desc(String feeDesc)
	{
		fee_desc = feeDesc;
	}

	public int getUser_id()
	{
		return user_id;
	}

	public void setUser_id(int userId)
	{
		user_id = userId;
	}

	public Date getCrt_dt()
	{
		return crt_dt;
	}

	public void setCrt_dt(Date crtDt)
	{
		crt_dt = crtDt;
	}

	public double getAmount()
	{
		return amount;
	}

	public void setAmount(double amount)
	{
		this.amount = amount;
	}

	public double getBalance()
	{
		return balance;
	}

	public void setBalance(double balance)
	{
		this.balance = balance;
	}
	
}