package com.dexter.bradawl.dto;

import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.model.BursaryModel;

public class FeePayment implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	private int payment_id;
	private int fee_amount_id;
	private int fee_id;
	private int damage_fee_id;
	private int student_id;
	private double amount_paid;
	private double balance;
	private Date date_paid;
	private int user_id;
	private Date crt_dt;
	
	private int term_id;
	
	private ArrayList<Fee> fees;
	private ArrayList<StudentDamageFee> damagesFees;
	
	private String fee_nm;
	private String fee_desc;
	private double fee_amount;
	private String student_nm;
	private String term_nm;
	
	private int type = 0;
	private int status = 1;
	
	private int payment_type;
	private int detail_id;
	private BankPayment bankPayment;
	private SwitchPayment switchPayment;
	
	public FeePayment()
	{}
	
	public int getFee_id()
	{
		return fee_id;
	}
	
	public void setFee_id(int fee_id)
	{
		if(type == 0)
		{
			if(fee_id > 0)
			{
				for(Fee e : getFees())
				{
					if(e.getFee_id() == fee_id)
					{
						setBalance(e.getBalance());
						break;
					}
				}
			}
			else
			{
				setBalance(0);
			}
		}
		
		this.fee_id = fee_id;
	}

	public int getPayment_id()
	{
		return payment_id;
	}

	public void setPayment_id(int paymentId)
	{
		payment_id = paymentId;
	}

	public int getFee_amount_id()
	{
		return fee_amount_id;
	}

	public void setFee_amount_id(int feeAmtId)
	{
		fee_amount_id = feeAmtId;
	}

	public int getStudent_id()
	{
		return student_id;
	}

	public void setStudent_id(int studentId)
	{
		if(type == 0)
		{
			if(studentId > 0)
			{
				setFees(new BursaryModel().GetStudentPayableFees(getTerm_id(), studentId));
			}
			else
			{
				setFees(null);
			}
		}
		
		student_id = studentId;
	}

	public double getAmount_paid()
	{
		return amount_paid;
	}

	public void setAmount_paid(double amountPaid)
	{
		amount_paid = amountPaid;
	}

	public double getBalance()
	{
		return balance;
	}

	public void setBalance(double balance)
	{
		this.balance = balance;
	}

	public Date getDate_paid()
	{
		return date_paid;
	}

	public void setDate_paid(Date datePaid)
	{
		date_paid = datePaid;
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

	public int getTerm_id()
	{
		return term_id;
	}

	public void setTerm_id(int termId)
	{
		term_id = termId;
	}

	public ArrayList<Fee> getFees()
	{
		if(fees == null)
			fees = new ArrayList<Fee>();
		return fees;
	}

	public void setFees(ArrayList<Fee> fees)
	{
		this.fees = fees;
	}

	public String getFee_nm()
	{
		return fee_nm;
	}

	public void setFee_nm(String fee_nm)
	{
		this.fee_nm = fee_nm;
	}

	public String getFee_desc()
	{
		return fee_desc;
	}

	public void setFee_desc(String fee_desc)
	{
		this.fee_desc = fee_desc;
	}

	public double getFee_amount() {
		return fee_amount;
	}

	public void setFee_amount(double fee_amount) {
		this.fee_amount = fee_amount;
	}

	public String getStudent_nm() {
		return student_nm;
	}

	public void setStudent_nm(String student_nm) {
		this.student_nm = student_nm;
	}

	public String getTerm_nm() {
		return term_nm;
	}

	public void setTerm_nm(String term_nm) {
		this.term_nm = term_nm;
	}

	public int getType()
	{
		return type;
	}

	public void setType(int type)
	{
		this.type = type;
	}

	public int getStatus() {
		return status;
	}

	public void setStatus(int status) {
		this.status = status;
	}

	public int getDamage_fee_id() {
		return damage_fee_id;
	}

	public void setDamage_fee_id(int damage_fee_id) {
		this.damage_fee_id = damage_fee_id;
	}

	public ArrayList<StudentDamageFee> getDamagesFees() {
		if(damagesFees == null)
			damagesFees = new ArrayList<StudentDamageFee>();
		
		if(student_id > 0)
		{
			// TODO: Get the student's damages
			damagesFees = new BursaryModel().GetStudentDamages(student_id);
		}
		
		return damagesFees;
	}

	public void setDamagesFees(ArrayList<StudentDamageFee> damagesFees) {
		this.damagesFees = damagesFees;
	}

	public int getPayment_type() {
		return payment_type;
	}

	public void setPayment_type(int payment_type) {
		this.payment_type = payment_type;
	}

	public int getDetail_id() {
		return detail_id;
	}

	public void setDetail_id(int detail_id) {
		this.detail_id = detail_id;
	}

	public BankPayment getBankPayment() {
		if(bankPayment == null)
			bankPayment = new BankPayment();
		return bankPayment;
	}

	public void setBankPayment(BankPayment bankPayment) {
		this.bankPayment = bankPayment;
	}

	public SwitchPayment getSwitchPayment() {
		if(switchPayment == null)
			switchPayment = new SwitchPayment();
		return switchPayment;
	}

	public void setSwitchPayment(SwitchPayment switchPayment) {
		this.switchPayment = switchPayment;
	}
	
}
