package com.dexter.bradawl.mbean;

import java.util.ArrayList;
import java.util.Date;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.log.Log;

import com.dexter.bradawl.dto.BankAccount;
import com.dexter.bradawl.dto.ClassFee;
import com.dexter.bradawl.dto.Debtor;
import com.dexter.bradawl.dto.Fee;
import com.dexter.bradawl.dto.FeeAmount;
import com.dexter.bradawl.dto.FeePayment;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Search;
import com.dexter.bradawl.dto.StudentDamageFee;
import com.dexter.bradawl.dto.SwitchAccount;
import com.dexter.bradawl.dto.Term;
import com.dexter.bradawl.model.BursaryModel;
import com.dexter.bradawl.model.RefModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("bursaryBean")
@Scope(ScopeType.SESSION)
public class BursaryBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@Logger
	private Log log;
	
	@In
	AppOptions appOptions;
	
	private Ref fee_category;
	private Fee fee;
	private FeeAmount fee_amount;
	private FeePayment fee_payment, damage_payment;
	
	private ArrayList<FeePayment> feePayments, damagesPayments;
	
	private ArrayList<Ref> feeCategories;
	private ArrayList<Fee> fees;
	private ArrayList<FeeAmount> feeAmounts;
	
	private ClassFee class_fee;
	private ArrayList<ClassFee> class_fees;
	
	private int student_id;
	private int dfee_id;
	private StudentDamageFee sdFee;
	private Date sdt, edt;
	private ArrayList<StudentDamageFee> sdFeesList;
	
	private Ref bank;
	private ArrayList<Ref> banks;
	private BankAccount bankAccount;
	private ArrayList<BankAccount> bankAccounts;
	private SwitchAccount switchAccount;
	private ArrayList<SwitchAccount> switchAccounts;
	
	private Search search;
	private ArrayList<FeePayment> paymentList;
	private ArrayList<Debtor> debtorsList;
	
	public void CreateFeeCategory()
	{
		if(getFee_category().getName() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Creating a fee category...");
			
			int ret = new BursaryModel().CreateFeeCategory(getFee_category());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setFee_category(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void UpdateFeeCategory()
	{
		if(getFee_category().getName() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Updating fee category with id: " + getFee_category().getId() + "...");
			
			int ret = new BursaryModel().UpdateFeeCategory(getFee_category());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setFee_category(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void CreateFee()
	{
		if(getFee().getFee_nm() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Creating a fee...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getFee().setUser_id(user_id);
			
			int ret = new BursaryModel().CreateFee(getFee());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setFee(null);
					setFees(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void UpdateFee()
	{}
	
	public void getFeesByCategory(int fee_cat_id)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Searching for fees by category id" + fee_cat_id + "...");
		setFees(new BursaryModel().GetFeeByCat(fee_cat_id));
		if(getFees().size() > 0)
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getFees().size()}), null));
		else
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
	}
	
	public void CreateFeeTermAmount()
	{
		if(getFee_amount().getFee_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Creating fee amount in current term...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			int term_id = 0;
			ArrayList<Term> list = appOptions.getSessionTerms();
			for(Term t : list)
			{
				if(t.getTerm_end_dt() == null)
				{
					term_id = t.getTerm_id();
					break;
				}
			}
			getFee_amount().setTerm_id(term_id);
			getFee_amount().setUser_id(user_id);
			
			int ret = new BursaryModel().CreateFeeTermAmount(getFee_amount());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setFee_amount(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void MapFeeToClass()
	{
		if(getClass_fee().getClass_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Creating fee amount in current term...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getClass_fee().setUser_id(user_id);
			int ret = new BursaryModel().MapClassToFeeCat(getClass_fee());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setClass_fee(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void UnMapClassFee()
	{}
	
	public void CreateBank()
	{
		if(getBank().getName() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting a new bank...");
			
			int ret = new RefModel().createRefObjects(13, getBank());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setBank(null);
					setBanks(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void UpdateBank()
	{
		if(getBank().getName() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Updating bank...");
			
			/*int ret = new RefModel().updateRefObjects(13, getBank());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setBank(null);
					setBanks(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}*/
		}
	}
	
	public void CreateBankAccount()
	{
		if(getBankAccount().getBank_id() > 0 && getBankAccount().getAccount_nm() != null && getBankAccount().getAccount_number() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting a new bank account...");
			
			int ret = new BursaryModel().createBankAccount(getBankAccount());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setBankAccount(null);
					setBankAccounts(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void UpdateBankAccount()
	{
		if(getBankAccount().getBank_id() > 0 && getBankAccount().getAccount_nm() != null && getBankAccount().getAccount_number() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Updating bank account...");
			
			/*int ret = new BursaryModel().updateBankAccount(getBankAccount());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setBankAccount(null);
					setBankAccounts(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}*/
		}
	}
	
	public void InsertStudentFeePayment()
	{
		if(getFee_payment().getStudent_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting fee payment...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getFee_payment().setUser_id(user_id);
			
			getFee_payment().setStatus(1);
			
			int ret = new BursaryModel().InsertStudentFeePayment(getFee_payment());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("payment.successful", null), null));
					setFee_payment(null);
					break;
				}
				case 3:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("payment.overpay", null), null));
					break;
				}
			}
		}
	}
	
	public void ViewStudentFeePayments()
	{
		if(getFee_payment().getStudent_id() > 0 && getFee_payment().getFee_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Viewing fee payments...");
			
			int term_id = appOptions.getCurrentTerm().getTerm_id();
			getFee_payment().setTerm_id(term_id);
			
			setFeePayments(new BursaryModel().GetStudentFeePayments(getFee_payment()));
			if(getFeePayments().size() > 0)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getFeePayments().size()}), null));
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
		}
	}
	
	private ArrayList<FeePayment> pendingFeePayments;
	
	public void setPendingFeePayments(ArrayList<FeePayment> pendingFeePayments)
	{
		this.pendingFeePayments = pendingFeePayments;
	}
	
	public ArrayList<FeePayment> getPendingFeePayments()
	{
		if(pendingFeePayments == null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Viewing pending fee payments...");
			pendingFeePayments = new BursaryModel().GetStudentPendingFeePayments();
			
			if(pendingFeePayments.size() > 0)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {pendingFeePayments.size()}), null));
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
		}
		return pendingFeePayments;
	}
	
	public void ApprovePendingFeePaymentStatus()
	{
		if(getFee_payment() != null && getFee_payment().getStatus() == 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Aproving pending fee payment...");
			
			getFee_payment().setStatus(1);
			
			boolean ret = new BursaryModel().UpdatePendingFeePayment(getFee_payment());
			
			if(ret)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("payment.approved", null), null));
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("payment.update.error", null), null));
			
			setFee_payment(null);
			setPendingFeePayments(null);
		}
	}
	
	public void DisapprovePendingFeePaymentStatus()
	{
		if(getFee_payment() != null && getFee_payment().getStatus() == 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Aproving pending fee payment...");
			
			getFee_payment().setStatus(-1);
			
			boolean ret = new BursaryModel().UpdatePendingFeePayment(getFee_payment());
			
			if(ret)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("payment.disapproved", null), null));
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("payment.update.error", null), null));
			
			setFee_payment(null);
			setPendingFeePayments(null);
		}
	}
	
	public void GuardianInsertStudentFeePayment()
	{
		if(getFee_payment().getStudent_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting fee payment...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getFee_payment().setUser_id(user_id);
			
			getFee_payment().setStatus(0);
			
			int ret = new BursaryModel().InsertStudentFeePayment(getFee_payment());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("payment.successful", null), null));
					setFee_payment(null);
					break;
				}
				case 3:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("payment.overpay", null), null));
					break;
				}
			}
		}
	}
	
	public void UpdateFeePayment()
	{
		
	}
	
	public void DeleteFeePayment()
	{
		
	}
	
	public void InsertStudentDamages()
	{
		if(getSdFee() != null && getSdFee().getStudent_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting student damages...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			int term_id = appOptions.getCurrentTerm().getTerm_id();
			getSdFee().setUser_id(user_id);
			getSdFee().setTerm_id(term_id);
			
			int ret = new BursaryModel().InsertStudentDamages(getSdFee());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("create.success", null), null));
					setClass_fee(null);
					break;
				}
				case 2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("entry.duplicate", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void SearchDamages()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Searching student damages...");
		
		setSdFeesList(null);
		
		setSdFeesList(new BursaryModel().GetDamages(getSdt(), getEdt()));
		
		if(getSdFeesList().size() > 0)
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getSdFeesList().size()}), null));
		else
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
	}
	
	public void SearchStudentDamages()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Searching student damages...");
		
		setSdFeesList(null);
		
		setSdFeesList(new BursaryModel().GetStudentDamages(getStudent_id()));
		
		if(getSdFeesList().size() > 0)
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getSdFeesList().size()}), null));
		else
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
	}
	
	public void InsertDamageFeePayment()
	{
		if(getSdFee() != null && getSdFee().getStudent_damage_fee_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Inserting student damages payment...");
			
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getSdFee().setUser_id(user_id);
			
			int ret = new BursaryModel().InsertStudentDamagesPayment(getSdFee());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("payment.successful", null), null));
					setFee_payment(null);
					break;
				}
				case 3:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("payment.overpay", null), null));
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("create.failed", null), null));
					break;
				}
			}
		}
	}
	
	public void ViewDamagePayments()
	{
		if(getDamage_payment().getStudent_id() > 0 && getDamage_payment().getFee_id() > 0)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Viewing damages payments...");
			
			int term_id = appOptions.getCurrentTerm().getTerm_id();
			getDamage_payment().setTerm_id(term_id);
			
			setDamagesPayments(new BursaryModel().GetStudentDamagesPayments(getDamage_payment().getStudent_id(), getDamage_payment().getFee_id()));
			if(getDamagesPayments().size() > 0)
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getDamagesPayments().size()}), null));
			else
				curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
		}
	}
	
	public void ViewPayments()
	{
		if(getSearch() != null)
		{
			FacesContext curContext = FacesContextImpl.getCurrentInstance();
			log.info("Viewing payments report...");
			
			if(getSearch() != null)
			{
				setPaymentList(new BursaryModel().getPaymentReport(getSearch().getSession_id(), getSearch().getTerm_id(), getSearch().getClass_lvl(), getSearch().getLvl_no(), getSearch().getClass_id(), getSearch().getStudent_id(), getSearch().getFee_cat_id()));
				if(getPaymentList().size() > 0)
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getPaymentList().size()}), null));
				else
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
			}
		}
	}
	
	public void ViewDebtors()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		log.info("Viewing debtors report...");
		
		setDebtorsList(new BursaryModel().getDebtors());
		if(getDebtorsList().size() > 0)
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("search.success", new Object[] {getDebtorsList().size()}), null));
		else
			curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_ERROR, Utils.getBundleMessage("search.failed", null), null));
	}

	public Ref getFee_category()
	{
		if(fee_category == null)
			fee_category = new Ref();
		return fee_category;
	}

	public void setFee_category(Ref fee_category)
	{
		this.fee_category = fee_category;
	}

	public Fee getFee()
	{
		if(fee == null)
			fee = new Fee();
		return fee;
	}

	public void setFee(Fee fee)
	{
		this.fee = fee;
	}

	public FeeAmount getFee_amount()
	{
		if(fee_amount == null)
			fee_amount = new FeeAmount();
		return fee_amount;
	}

	public void setFee_amount(FeeAmount fee_amount)
	{
		this.fee_amount = fee_amount;
	}

	public FeePayment getFee_payment()
	{
		if(fee_payment == null)
			fee_payment = new FeePayment();
		return fee_payment;
	}

	public void setFee_payment(FeePayment fee_payment)
	{
		this.fee_payment = fee_payment;
	}

	public FeePayment getDamage_payment() {
		if(damage_payment == null)
			damage_payment = new FeePayment();
		return damage_payment;
	}

	public void setDamage_payment(FeePayment damage_payment) {
		this.damage_payment = damage_payment;
	}

	public ArrayList<Ref> getFeeCategories()
	{
		feeCategories = new BursaryModel().GetFeeCategories();
		return feeCategories;
	}

	public void setFeeCategories(ArrayList<Ref> feeCategories)
	{
		this.feeCategories = feeCategories;
	}

	public ArrayList<Fee> getFees()
	{
		if(getFee().getFee_cat_id() > 0)
			fees = new BursaryModel().GetFeeByCat(getFee().getFee_cat_id());
		else
			fees = new ArrayList<Fee>();
		
		return fees;
	}

	public void setFees(ArrayList<Fee> fees)
	{
		this.fees = fees;
	}

	public ArrayList<FeeAmount> getFeeAmounts()
	{
		int term_id = 0;
		
		try
		{
			term_id = appOptions.getCurrentTerm().getTerm_id();
		}
		catch(Exception ig){}
		
		feeAmounts = new BursaryModel().GetFeesAmounts(term_id, getFee_amount().getFee_cat_id());
		
		return feeAmounts;
	}

	public void setFeeAmounts(ArrayList<FeeAmount> feeAmounts)
	{
		this.feeAmounts = feeAmounts;
	}

	public ClassFee getClass_fee()
	{
		if(class_fee == null)
			class_fee = new ClassFee();
		return class_fee;
	}

	public void setClass_fee(ClassFee class_fee)
	{
		this.class_fee = class_fee;
	}

	public ArrayList<ClassFee> getClass_fees()
	{
		//if(class_fees == null)
		//	class_fees = new ArrayList<ClassFee>();
		
		//class_fees.clear();
		
		if(getClass_fee().getClass_id() > 0)
		{
			class_fees = new BursaryModel().GetClassFeeMapping(getClass_fee().getClass_id());
		}
		else
		{
			class_fees = new ArrayList<ClassFee>();
		}
		
		return class_fees;
	}

	public void setClass_fees(ArrayList<ClassFee> class_fees)
	{
		this.class_fees = class_fees;
	}

	public int getStudent_id() {
		return student_id;
	}

	public void setStudent_id(int student_id) {
		this.student_id = student_id;
	}

	public int getDfee_id() {
		return dfee_id;
	}

	public void setDfee_id(int dfee_id) {
		this.dfee_id = dfee_id;
	}

	public StudentDamageFee getSdFee()
	{
		if(sdFee == null)
			sdFee = new StudentDamageFee();
		return sdFee;
	}

	public void setSdFee(StudentDamageFee sdFee)
	{
		this.sdFee = sdFee;
	}

	public Date getSdt()
	{
		return sdt;
	}

	public void setSdt(Date sdt)
	{
		this.sdt = sdt;
	}

	public Date getEdt()
	{
		return edt;
	}

	public void setEdt(Date edt)
	{
		this.edt = edt;
	}
	
	public ArrayList<StudentDamageFee> getStudentDamagesFees()
	{
		return new BursaryModel().GetStudentDamages(getStudent_id());
	}
	
	public StudentDamageFee getStudentDamagesFee()
	{
		StudentDamageFee e = new StudentDamageFee();
		ArrayList<StudentDamageFee> list = getStudentDamagesFees();
		for(StudentDamageFee sdf : list)
		{
			if(sdf.getStudent_damage_fee_id() == getDfee_id())
			{
				setSdFee(sdf);
				e = sdf;
				break;
			}
		}
		
		return e;
	}

	public ArrayList<StudentDamageFee> getSdFeesList()
	{
		return sdFeesList;
	}

	public void setSdFeesList(ArrayList<StudentDamageFee> sdFeesList)
	{
		this.sdFeesList = sdFeesList;
	}

	public ArrayList<FeePayment> getFeePayments()
	{
		if(feePayments == null)
			feePayments = new ArrayList<FeePayment>();
		return feePayments;
	}

	public void setFeePayments(ArrayList<FeePayment> feePayments)
	{
		this.feePayments = feePayments;
	}

	public ArrayList<FeePayment> getDamagesPayments() {
		if(damagesPayments == null)
			damagesPayments = new ArrayList<FeePayment>();
		return damagesPayments;
	}

	public void setDamagesPayments(ArrayList<FeePayment> damagesPayments) {
		this.damagesPayments = damagesPayments;
	}

	public Ref getBank() {
		if(bank == null)
			bank = new Ref();
		return bank;
	}

	public void setBank(Ref bank) {
		this.bank = bank;
	}

	public ArrayList<Ref> getBanks() {
		// if(banks == null)
			banks = new RefModel().getRefObjects(16);
		return banks;
	}

	public void setBanks(ArrayList<Ref> banks) {
		this.banks = banks;
	}

	public BankAccount getBankAccount() {
		if(bankAccount == null)
			bankAccount = new BankAccount();
		return bankAccount;
	}

	public void setBankAccount(BankAccount bankAccount) {
		this.bankAccount = bankAccount;
	}

	public ArrayList<BankAccount> getBankAccounts() {
		// if(bankAccounts == null)
			bankAccounts = new BursaryModel().getBankAccounts();
		return bankAccounts;
	}

	public void setBankAccounts(ArrayList<BankAccount> bankAccounts) {
		this.bankAccounts = bankAccounts;
	}

	public SwitchAccount getSwitchAccount() {
		if(switchAccount == null)
			switchAccount = new SwitchAccount();
		return switchAccount;
	}

	public void setSwitchAccount(SwitchAccount switchAccount) {
		this.switchAccount = switchAccount;
	}

	public ArrayList<SwitchAccount> getSwitchAccounts() {
		if(switchAccounts == null)
			switchAccounts = new ArrayList<SwitchAccount>();
		return switchAccounts;
	}

	public void setSwitchAccounts(ArrayList<SwitchAccount> switchAccounts) {
		this.switchAccounts = switchAccounts;
	}

	public Search getSearch() {
		if(search == null)
		{
			search = new Search();
		}
		return search;
	}

	public void setSearch(Search search) {
		this.search = search;
	}

	public ArrayList<FeePayment> getPaymentList() {
		if(paymentList == null)
		{
			paymentList = new ArrayList<FeePayment>();
		}
		return paymentList;
	}

	public void setPaymentList(ArrayList<FeePayment> paymentList) {
		this.paymentList = paymentList;
	}

	public ArrayList<Debtor> getDebtorsList() {
		if(debtorsList == null)
			debtorsList = new ArrayList<Debtor>();
		return debtorsList;
	}

	public void setDebtorsList(ArrayList<Debtor> debtorsList) {
		this.debtorsList = debtorsList;
	}
	
}
