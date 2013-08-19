package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.BursaryModel;

public class BankPayment
{
	private int id;
	private int bank_account_id;
	private String teller_number;
	private Date tran_dt;
	private int user_id;
	private int status;
	
	private BankAccount account;
	
	public BankPayment()
	{}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getBank_account_id() {
		return bank_account_id;
	}

	public void setBank_account_id(int bank_account_id) {
		this.bank_account_id = bank_account_id;
		if(bank_account_id > 0)
		{
			ArrayList<BankAccount> list = new BursaryModel().getBankAccounts();
			for(BankAccount e : list)
			{
				if(e.getId() == bank_account_id)
				{
					setAccount(e);
					break;
				}
			}
		}
	}

	public BankAccount getAccount() {
		if(account == null)
			account = new BankAccount();
		return account;
	}

	public void setAccount(BankAccount account) {
		this.account = account;
	}

	public String getTeller_number() {
		return teller_number;
	}

	public void setTeller_number(String teller_number) {
		this.teller_number = teller_number;
	}

	public Date getTran_dt() {
		return tran_dt;
	}

	public void setTran_dt(Date tran_dt) {
		this.tran_dt = tran_dt;
	}

	public int getUser_id() {
		return user_id;
	}

	public void setUser_id(int user_id) {
		this.user_id = user_id;
	}

	public int getStatus() {
		return status;
	}

	public void setStatus(int status) {
		this.status = status;
	}
	
}
