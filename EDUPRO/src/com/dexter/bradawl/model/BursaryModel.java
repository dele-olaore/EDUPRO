package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.ArrayList;
import java.util.Date;
import java.util.LinkedHashMap;

import com.dexter.bradawl.dto.BankAccount;
import com.dexter.bradawl.dto.BankPayment;
import com.dexter.bradawl.dto.ClassFee;
import com.dexter.bradawl.dto.Debtor;
import com.dexter.bradawl.dto.Fee;
import com.dexter.bradawl.dto.FeeAmount;
import com.dexter.bradawl.dto.FeePayment;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.StudentDamageFee;
import com.dexter.bradawl.util.Env;

public class BursaryModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public BursaryModel()
	{}
	
	/**
	 * Used internally to connect to the bradawlnew database.
	 * */
	private void connectToDB() throws Exception
	{
		closeConnection();
		
		con = Env.getConnectionBradawl();
	}
	
	/**
	 * Used internally to close the connection after use. 
	 * */
	private void closeConnection()
	{
		if(result != null)
		{
			try
			{
				result.close();
				result = null;
			}
			catch(Exception ignore){}
		}
		if(con != null)
		{
			try
			{
				con.close();
				con = null;
			}
			catch(Exception ignore){}
		}
	}
	
	/**
	 * Creates a new fee category.
	 * */
	public int CreateFeeCategory(Ref feeCat)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_fee_category_sp(?,?,?)}");
			stored_procedure.setString(1, feeCat.getName());
			stored_procedure.setString(2, feeCat.getDesc());
			stored_procedure.setInt(3, -1);
			stored_procedure.registerOutParameter(3, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(3);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			try
			{
				con.rollback();
			}
			catch(Exception ig){}
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Updates changes to a fee category
	 * */
	public int UpdateFeeCategory(Ref feeCat)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_fee_category_sp(?,?,?,?)}");
			stored_procedure.setInt(1, feeCat.getId());
			stored_procedure.setString(2, feeCat.getName());
			stored_procedure.setString(3, feeCat.getDesc());
			stored_procedure.setInt(4, -1);
			stored_procedure.registerOutParameter(4, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(4);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			try
			{
				con.rollback();
			}
			catch(Exception ig){}
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	public ArrayList<Ref> GetFeeCategories()
	{
		ArrayList<Ref> list = new ArrayList<Ref>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_fee_categories_sp}");
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Ref e = new Ref();
				e.setId(result.getInt(1));
				e.setName(result.getString(2));
				e.setDesc(result.getString(3));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	public int CreateFee(Fee fee)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_fee_sp(?,?,?,?,?)}");
			stored_procedure.setInt(1, fee.getFee_cat_id());
			stored_procedure.setString(2, fee.getFee_nm());
			stored_procedure.setString(3, fee.getFee_desc());
			stored_procedure.setInt(4, fee.getUser_id());
			stored_procedure.setInt(5, -1);
			stored_procedure.registerOutParameter(5, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(5);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			try
			{
				con.rollback();
			}
			catch(Exception ig){}
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets fees by category.
	 * */
	public ArrayList<Fee> GetFeeByCat(int fee_cat_id)
	{
		ArrayList<Fee> list = new ArrayList<Fee>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_fees_bycatid_sp(?)}");
			stored_procedure.setInt(1, fee_cat_id);
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Fee e = new Fee();
				
				e.setFee_id(result.getInt(1));
				e.setFee_cat_id(result.getInt(2));
				e.setFee_nm(result.getString(3));
				e.setFee_desc(result.getString(4));
				e.setUser_id(result.getInt(5));
				e.setCrt_dt(result.getDate(6));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Create fee amount for the current term.
	 * */
	public int CreateFeeTermAmount(FeeAmount famt)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_fee_amount_sp(?,?,?,?,?)}");
			stored_procedure.setInt(1, famt.getFee_id());
			stored_procedure.setInt(2, famt.getTerm_id());
			stored_procedure.setDouble(3, famt.getFee_amount());
			stored_procedure.setInt(4, famt.getUser_id());
			stored_procedure.setInt(5, -1);
			stored_procedure.registerOutParameter(5, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(5);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets fee amount for a term.
	 * */
	public ArrayList<FeeAmount> GetFeesAmounts(int term_id, int fee_cat_id)
	{
		ArrayList<FeeAmount> list = new ArrayList<FeeAmount>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_fee_amountbyterm_sp(?,?)}");
			stored_procedure.setInt(1, term_id);
			stored_procedure.setInt(2, fee_cat_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				FeeAmount fa = new FeeAmount();
				
				fa.setFee_amount_id(result.getInt(1));
				fa.setFee_id(result.getInt(2));
				fa.setFee_nm(result.getString(3));
				fa.setTerm_id(result.getInt(4));
				fa.setTerm_nm(result.getString(5));
				fa.setFee_amount(result.getDouble(6));
				fa.setUser_id(result.getInt(7));
				fa.setCrt_dt(result.getDate(8));
				fa.setFee_cat_nm(result.getString(9));
				
				list.add(fa);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	public int MapClassToFeeCat(ClassFee cf)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_class_feecat_sp(?,?,?,?)}");
			stored_procedure.setInt(1, cf.getClass_id());
			stored_procedure.setInt(2, cf.getFee_cat_id());
			stored_procedure.setInt(3, cf.getUser_id());
			stored_procedure.setInt(4, -1);
			stored_procedure.registerOutParameter(4, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(4);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			try
			{
				con.rollback();
			}
			catch(Exception ig){}
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	public ArrayList<ClassFee> GetClassFeeMapping(int class_id)
	{
		ArrayList<ClassFee> list = new ArrayList<ClassFee>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_class_feecats_sp(?)}");
			stored_procedure.setInt(1, class_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				ClassFee e = new ClassFee();
				
				// class_fee_id, class_id, fee_cat_id, [user_id], crt_dt
				e.setClass_id(result.getInt(2));
				e.setFee_cat_id(result.getInt(3));
				e.setUser_id(result.getInt(4));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Gets a students payable fees.
	 * */
	public ArrayList<Fee> GetStudentPayableFees(int term_id, int student_id)
	{
		ArrayList<Fee> list = new ArrayList<Fee>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_payable_fess_sp(?,?)}");
			stored_procedure.setInt(1, term_id);
			stored_procedure.setInt(2, student_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Fee e = new Fee();
				
				e.setFee_id(result.getInt(1));
				e.setFee_cat_id(result.getInt(2));
				e.setFee_nm(result.getString(3));
				e.setFee_desc(result.getString(4));
				e.setAmount(result.getDouble(5));
				e.setBalance(result.getDouble(6));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Inserts a student's fee payment.
	 * */
	public int InsertStudentFeePayment(FeePayment fp)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			int detail_id = 0;
			
			if(fp.getPayment_type() == 1) // bank
			{
				stored_procedure = con.prepareCall("{call crt_bank_payment_sp(?,?,?,?,?,?,?)}");
				stored_procedure.setInt(1, fp.getBankPayment().getBank_account_id());
				stored_procedure.setString(2, fp.getBankPayment().getTeller_number());
				stored_procedure.setDate(3, new java.sql.Date(fp.getDate_paid().getTime()));
				stored_procedure.setInt(4, fp.getUser_id());
				stored_procedure.setInt(5, -1);
				stored_procedure.setInt(6, fp.getStatus());
				stored_procedure.setInt(7, -1);
				stored_procedure.registerOutParameter(5, Types.INTEGER);
				stored_procedure.registerOutParameter(7, Types.INTEGER);
				
				stored_procedure.execute();
				
				detail_id = stored_procedure.getInt(7);
			}
			
			stored_procedure = con.prepareCall("{call crt_student_fee_payment_sp(?,?,?,?,?,?,?,?,?,?,?)}");
			stored_procedure.setInt(1, fp.getFee_id());
			stored_procedure.setInt(2, fp.getTerm_id());
			stored_procedure.setInt(3, fp.getStudent_id());
			stored_procedure.setDouble(4, fp.getAmount_paid());
			stored_procedure.setDate(5, new java.sql.Date(fp.getDate_paid().getTime()));
			stored_procedure.setInt(6, fp.getUser_id());
			stored_procedure.setDouble(7, 0);
			stored_procedure.setInt(8, -1);
			stored_procedure.setInt(9, fp.getStatus());
			stored_procedure.setInt(10, fp.getPayment_type());
			stored_procedure.setInt(11, detail_id);
			stored_procedure.registerOutParameter(8, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(8);
			
			if(ret == 0)
			{
				con.commit();
			}
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets student fee payments
	 * */
	public ArrayList<FeePayment> GetStudentFeePayments(FeePayment fp)
	{
		ArrayList<FeePayment> list = new ArrayList<FeePayment>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_fee_payments_sp(?,?,?)}");
			stored_procedure.setInt(1, fp.getTerm_id());
			stored_procedure.setInt(2, fp.getStudent_id());
			stored_procedure.setInt(3, fp.getFee_id());
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				FeePayment e = new FeePayment();
				// student_fee_payment_id, sfp.fee_amount_id, fa.fee_id, f.fee_nm, f.fee_desc, student_id, sfp.term_id, amt_paid, balance, dt_paid, sfp.user_id, sfp.crt_dt
				e.setType(1); // viewing
				e.setPayment_id(result.getInt(1));
				e.setFee_amount_id(result.getInt(2));
				e.setFee_id(result.getInt(3));
				e.setFee_nm(result.getString(4));
				e.setFee_desc(result.getString(5));
				e.setStudent_id(result.getInt(6));
				e.setTerm_id(result.getInt(7));
				e.setAmount_paid(result.getDouble(8));
				e.setBalance(result.getDouble(9));
				e.setDate_paid(result.getDate(10));
				e.setUser_id(result.getInt(11));
				e.setCrt_dt(result.getDate(12));
				e.setStatus(result.getInt(13));
				e.setPayment_type(result.getInt(14));
				e.setDetail_id(result.getInt(15));
				
				list.add(e);
			}
			
			for(FeePayment e : list)
			{
				if(e.getPayment_type() == 1) // bank teller
				{
					stored_procedure = con.prepareCall("{call get_bank_paymentbyid_sp(?)}");
					stored_procedure.setInt(1, e.getDetail_id());
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						// bank_payment_id, bank_account_id, teller_number, tran_dt, user_id, crt_dt, status
						BankPayment bp = new BankPayment();
						bp.setId(result.getInt(1));
						bp.setBank_account_id(result.getInt(2));
						bp.setTeller_number(result.getString(3));
						bp.setTran_dt(result.getDate(4));
						bp.setUser_id(result.getInt(5));
						bp.setStatus(result.getInt(7));
						
						e.setBankPayment(bp);
					}
					
				}
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Gets student pending fee payments
	 * */
	public ArrayList<FeePayment> GetStudentPendingFeePayments()
	{
		ArrayList<FeePayment> list = new ArrayList<FeePayment>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_students_fee_pending_payments_sp}");
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				FeePayment e = new FeePayment();
				// student_fee_payment_id, sfp.fee_amount_id, fa.fee_id, f.fee_nm, f.fee_desc, student_id, sfp.term_id, amt_paid, balance, dt_paid, sfp.user_id, sfp.crt_dt
				e.setType(1); // viewing
				e.setPayment_id(result.getInt(1));
				e.setFee_amount_id(result.getInt(2));
				e.setFee_id(result.getInt(3));
				e.setFee_nm(result.getString(4));
				e.setFee_desc(result.getString(5));
				e.setStudent_id(result.getInt(6));
				e.setTerm_id(result.getInt(7));
				e.setAmount_paid(result.getDouble(8));
				e.setBalance(result.getDouble(9));
				e.setDate_paid(result.getDate(10));
				e.setUser_id(result.getInt(11));
				e.setCrt_dt(result.getDate(12));
				e.setStatus(result.getInt(13));
				e.setPayment_type(result.getInt(14));
				e.setDetail_id(result.getInt(15));
				
				list.add(e);
			}
			
			for(FeePayment e : list)
			{
				if(e.getPayment_type() == 1) // bank teller
				{
					stored_procedure = con.prepareCall("{call get_bank_paymentbyid_sp(?)}");
					stored_procedure.setInt(1, e.getDetail_id());
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						// bank_payment_id, bank_account_id, teller_number, tran_dt, user_id, crt_dt, status
						BankPayment bp = new BankPayment();
						bp.setId(result.getInt(1));
						bp.setBank_account_id(result.getInt(2));
						bp.setTeller_number(result.getString(3));
						bp.setTran_dt(result.getDate(4));
						bp.setUser_id(result.getInt(5));
						bp.setStatus(result.getInt(7));
						
						e.setBankPayment(bp);
					}
					
				}
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	public boolean UpdatePendingFeePayment(FeePayment fp)
	{
		boolean ret = false;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call upd_student_fee_payment_status_sp(?,?,?)}");
			stored_procedure.setInt(1, fp.getPayment_id());
			stored_procedure.setInt(2, fp.getStatus());
			stored_procedure.setInt(3, -1);
			stored_procedure.registerOutParameter(3, Types.INTEGER);
			
			stored_procedure.execute();
			
			int retcode = stored_procedure.getInt(3);
			if(retcode == 0)
			{
				con.commit();
				ret = true;
			}
			else
			{
				con.rollback();
				ret = false;
			}			
			
			closeConnection();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Inserts student damages/charges
	 * */
	public int InsertStudentDamages(StudentDamageFee sdf)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_student_damage_fee_sp(?,?,?,?,?,?,?)}");
			stored_procedure.setString(1, sdf.getDamage_fee_desc());
			stored_procedure.setDouble(2, sdf.getDamage_fee_amount());
			stored_procedure.setInt(3, sdf.getStudent_id());
			stored_procedure.setInt(4, sdf.getTerm_id());
			stored_procedure.setDate(5, new java.sql.Date(sdf.getDate_damaged().getTime()));
			stored_procedure.setInt(6, sdf.getUser_id());
			stored_procedure.setInt(7, -1);
			stored_procedure.registerOutParameter(7, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(7);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets student damages or charges by date range.
	 * */
	public ArrayList<StudentDamageFee> GetDamages(Date st, Date ed)
	{
		ArrayList<StudentDamageFee> list = new ArrayList<StudentDamageFee>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_students_damages_fee_sp(?,?)}");
			stored_procedure.setDate(1, new java.sql.Date(st.getTime()));
			stored_procedure.setDate(2, new java.sql.Date(ed.getTime()));
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				StudentDamageFee e = new StudentDamageFee();
				// student_damage_fee_id, damage_fee_desc, damage_fee_amount, student_id, term_id, date_damaged, user_id, crt_dt
				e.setStudent_damage_fee_id(result.getInt(1));
				e.setDamage_fee_desc(result.getString(2));
				e.setDamage_fee_amount(result.getDouble(3));
				e.setStudent_id(result.getInt(4));
				e.setTerm_id(result.getInt(5));
				e.setDate_damaged(result.getDate(6));
				e.setUser_id(result.getInt(7));
				e.setCrt_dt(result.getDate(8));
				
				e.setStudent_nm(result.getString(9));
				e.setAmt_paid(result.getDouble(10));
				e.setAmt_bal(result.getDouble(11));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Gets student damages or charges by date range.
	 * */
	public ArrayList<StudentDamageFee> GetStudentDamages(int student_id)
	{
		ArrayList<StudentDamageFee> list = new ArrayList<StudentDamageFee>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_damages_fee_sp(?)}");
			stored_procedure.setInt(1, student_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				StudentDamageFee e = new StudentDamageFee();
				// student_damage_fee_id, damage_fee_desc, damage_fee_amount, student_id, term_id, date_damaged, user_id, crt_dt
				e.setStudent_damage_fee_id(result.getInt(1));
				e.setDamage_fee_desc(result.getString(2));
				e.setDamage_fee_amount(result.getDouble(3));
				e.setStudent_id(result.getInt(4));
				e.setTerm_id(result.getInt(5));
				e.setDate_damaged(result.getDate(6));
				e.setUser_id(result.getInt(7));
				e.setCrt_dt(result.getDate(8));
				
				e.setStudent_nm(result.getString(9));
				e.setAmt_paid(result.getDouble(10));
				e.setAmt_bal(result.getDouble(11));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Inserts a student's damages payment.
	 * */
	public int InsertStudentDamagesPayment(StudentDamageFee dp)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_student_damage_fee_payment_sp(?,?,?,?,?,?,?)}");
			stored_procedure.setInt(1, dp.getStudent_damage_fee_id());
			stored_procedure.setInt(2, dp.getStudent_id());
			stored_procedure.setDouble(3, dp.getAmt_paid());
			stored_procedure.setDate(4, new java.sql.Date(dp.getDate_paid().getTime()));
			stored_procedure.setInt(5, dp.getUser_id());
			stored_procedure.setDouble(6, 0);
			stored_procedure.setInt(7, -1);
			stored_procedure.registerOutParameter(6, Types.INTEGER);
			stored_procedure.registerOutParameter(7, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(7);
			
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets student damages payments
	 * */
	public ArrayList<FeePayment> GetStudentDamagesPayments(int student_id, int damage_fee_id)
	{
		ArrayList<FeePayment> list = new ArrayList<FeePayment>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_damage_payments_sp(?,?)}");
			stored_procedure.setInt(1, student_id);
			stored_procedure.setInt(2, damage_fee_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				FeePayment e = new FeePayment();
				// sdfp.student_damage_fee_payment_id, sdf.student_damage_fee_id, sdf.damage_fee_desc, sdf.student_id, sdf.term_id, sdfp.amount_paid, sdfp.balance, sdfp.date_paid, 
				// sdfp.user_id, sdfp.crt_dt
				e.setType(1); // viewing
				e.setPayment_id(result.getInt(1));
				e.setFee_id(result.getInt(2));
				e.setFee_nm(result.getString(3));
				e.setStudent_id(result.getInt(4));
				e.setTerm_id(result.getInt(5));
				e.setAmount_paid(result.getDouble(6));
				e.setBalance(result.getDouble(7));
				e.setDate_paid(result.getDate(8));
				e.setUser_id(result.getInt(9));
				e.setCrt_dt(result.getDate(10));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Creates a new bank account.
	 * */
	public int createBankAccount(BankAccount bka)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_bankaccount_sp(?,?,?,?)}");
			stored_procedure.setInt(1, bka.getBank_id());
			stored_procedure.setString(2, bka.getAccount_nm());
			stored_procedure.setString(3, bka.getAccount_number());
			stored_procedure.setInt(4, -1);
			stored_procedure.registerOutParameter(4, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(4);
			
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets available bank accounts.
	 * */
	public ArrayList<BankAccount> getBankAccounts()
	{
		ArrayList<BankAccount> list = new ArrayList<BankAccount>();
		
		try
		{
			connectToDB();
			// bank_account_id, ba.bank_id, bank_nm, account_nm, account_number, ba.crt_dt
			stored_procedure = con.prepareCall("{call get_bankaccounts_sp}");
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				BankAccount e = new BankAccount();
				
				e.setId(result.getInt(1));
				e.setBank_id(result.getInt(2));
				e.setBank_nm(result.getString(3));
				e.setAccount_nm(result.getString(4));
				e.setAccount_number(result.getString(5));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Gets payment report.
	 * */
	public ArrayList<FeePayment> getPaymentReport(int session_id, int term_id, String class_lvl, int lvl_no, int class_id, int student_id, int fee_cat_id)
	{
		ArrayList<FeePayment> list = new ArrayList<FeePayment>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_payment_report_sp(?,?,?,?,?,?,?)}");
			
			stored_procedure.setInt(1, session_id);
			stored_procedure.setInt(2, term_id);
			if(class_lvl != null && class_lvl.trim().length() > 0)
				stored_procedure.setString(3, class_lvl);
			else
				stored_procedure.setNull(3, Types.CHAR);
			
			stored_procedure.setInt(4, lvl_no);
			stored_procedure.setInt(5, class_id);
			stored_procedure.setInt(6, student_id);
			stored_procedure.setInt(7, fee_cat_id);
			
			result = stored_procedure.executeQuery();
			
			while(result.next())
			{
				FeePayment e = new FeePayment();
				e.setType(-1);
				// student_fee_payment_id, fa.fee_amount_id, fee_nm, fee_amount, sfp.student_id, student_fn + '' '' + student_ln as student_nm, sfp.term_id,
				// term_nm, amt_paid, balance, dt_paid, sfp.user_id, sfp.crt_dt
				e.setFee_amount_id(result.getInt(2));
				e.setFee_nm(result.getString(3));
				e.setFee_amount(result.getDouble(4));
				e.setStudent_id(result.getInt(5));
				e.setStudent_nm(result.getString(6));
				e.setTerm_id(result.getInt(7));
				e.setTerm_nm(result.getString(8));
				e.setAmount_paid(result.getDouble(9));
				e.setBalance(result.getDouble(10));
				e.setDate_paid(result.getDate(11));
				e.setUser_id(result.getInt(12));
				e.setCrt_dt(result.getDate(13));
				
				list.add(e);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Gets debtors.
	 * */
	public ArrayList<Debtor> getDebtors()
	{
		ArrayList<Debtor> list = new ArrayList<Debtor>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_debtors_sp}");
			result = stored_procedure.executeQuery();
			
			Debtor d = null;
			int student_id = 0;
			while(result.next())
			{
				// sfp.student_id, student_fn, student_mn, student_ln, rollNumber, sfp.term_id, term_nm, ss.session_id, session_nm, balance
				int cur_student_id = result.getInt(1);
				if(student_id == 0)
				{
					d = new Debtor();
					d.setStudent_id(cur_student_id);
					d.setStudent_nm(result.getString(2) + " " + result.getString(3) + " " + result.getString(4));
				}
				else if(cur_student_id != student_id)
				{
					list.add(d);
					d = new Debtor();
					
					d.setStudent_id(cur_student_id);
					d.setStudent_nm(result.getString(2) + " " + result.getString(3) + " " + result.getString(4));
				}
				
				String[] e = new String[]{result.getString(6), result.getString(7), result.getString(8), result.getString(9), result.getString(10)};
				d.getDebts().add(e);
				d.setTotal_debt(d.getTotal_debt() + Double.parseDouble(e[4]));
				
				student_id = cur_student_id;
			}
			
			if(d != null)
			{
				list.add(d);
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
}
