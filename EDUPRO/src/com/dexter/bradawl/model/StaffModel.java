package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import java.sql.Types;
import java.util.ArrayList;
import java.util.Date;
import java.util.Random;

import org.jboss.seam.annotations.In;
import org.jboss.seam.faces.Renderer;

import com.dexter.bradawl.dto.Address;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Staff;
import com.dexter.bradawl.dto.User;
import com.dexter.bradawl.security.Encrypter;
import com.dexter.bradawl.util.Emailer;
import com.dexter.bradawl.util.Env;

public class StaffModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con, conEduPro;
	private CallableStatement stored_procedure;
	private Statement edu_stat;
	private ResultSet result, resultEduPro;
	
	// private int output = -1;
	// private String empty = "";
	
	private String[] letters = new String[] {"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"};
	
	@In(create=true)
	private Renderer renderer;
	
	public StaffModel()
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
	 * Used internally to connect to the bradawlnew database.
	 * */
	private void connectToEduProDB() throws Exception
	{
		closeEduProConnection();
		
		conEduPro = Env.getConnectionEduPro();
	}
	
	/**
	 * Used internally to close the connection after use. 
	 * */
	private void closeEduProConnection()
	{
		if(resultEduPro != null)
		{
			try
			{
				resultEduPro.close();
				resultEduPro = null;
			}
			catch(Exception ignore){}
		}
		if(conEduPro != null)
		{
			try
			{
				conEduPro.close();
				conEduPro = null;
			}
			catch(Exception ignore){}
		}
	}
	
	/**
	 * Creates a new staff.
	 * */
	public int CreateStaff(final Staff s)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_address_sp(?,?,?,?,?,?,?,?,?)}");
			stored_procedure.setString(1, s.getAddress().getAddr1());
			stored_procedure.setString(2, s.getAddress().getAddr2());
			stored_procedure.setString(3, s.getAddress().getPhone1());
			stored_procedure.setString(4, s.getAddress().getPhone2());
			stored_procedure.setString(5, s.getAddress().getEmail());
			stored_procedure.setString(6, s.getAddress().getFax());
			stored_procedure.setString(7, s.getAddress().getWebsite());
			stored_procedure.setInt(8, -1); // addr_id
			stored_procedure.setInt(9, -1); // output code
			stored_procedure.registerOutParameter(8, Types.INTEGER);
			stored_procedure.registerOutParameter(9, Types.INTEGER);
			
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(9);
			if(ret == 0)
			{
				int addr_id = stored_procedure.getInt(8);
				
				stored_procedure = con.prepareCall("{call crt_staff_sp(?,?,?,?,?,?,?,?,?,?,?)}");
				stored_procedure.setString(1, s.getStaff_fn());
				stored_procedure.setString(2, s.getStaff_mn());
				stored_procedure.setString(3, s.getStaff_ln());
				stored_procedure.setInt(4, s.getStaff_cat_id());
				stored_procedure.setInt(5, s.getDepartment_id());
				stored_procedure.setInt(6, addr_id);
				stored_procedure.setInt(7, s.getStatus_id());
				stored_procedure.setDate(8, new java.sql.Date(s.getDt_employed().getTime()));
				stored_procedure.setInt(9, s.getUser_id());
				stored_procedure.setInt(10, -1); // staff id
				stored_procedure.setInt(11, -1); // output
				
				stored_procedure.registerOutParameter(10, Types.INTEGER);
				stored_procedure.registerOutParameter(11, Types.INTEGER);
				stored_procedure.execute();
				
				ret = stored_procedure.getInt(11);
				if(ret == 0)
				{
					int staff_id = stored_procedure.getInt(10);
					s.setStaff_id(staff_id);
					if(s.getHasUser())
					{
						String sid = ""+staff_id;
						if(sid.length() == 1)
							sid = "00"+sid;
						else if(sid.length() == 2)
							sid = "0"+sid;
						
						s.getUser().setUsername("S" + staff_id);
						
						String ramPass = "password";
						
						/*for(int i=0; i<8; i++)
						{
							Random ran = new Random();
							String l = letters[ran.nextInt(letters.length)];
							ramPass = ramPass + l;
						}*/
						
						final String ramPass2 = ramPass;
						// System.out.println("Pass: " + ramPass);
						s.getUser().setUser_password(Encrypter.Encrypt(ramPass)); // generate a ramdom password
						
						stored_procedure = con.prepareCall("{call crt_user_sp(?,?,?,?,?,?,?)}");
						stored_procedure.setString(1, s.getUser().getUsername());
						stored_procedure.setString(2, s.getUser().getUser_password());
						stored_procedure.setInt(3, s.getUser().getRole_id());
						stored_procedure.setInt(4, staff_id);
						stored_procedure.setString(5, "Y");
						stored_procedure.setInt(6, -1); // user_id
						stored_procedure.setInt(7, -1); // output
						stored_procedure.registerOutParameter(6, Types.INTEGER);
						stored_procedure.registerOutParameter(7, Types.INTEGER);
						
						stored_procedure.execute();
						
						ret = stored_procedure.getInt(7);
						if(ret == 0)
						{
							s.getUser().setUser_password(ramPass2); // set the normal password back so it can be displayed
							
							//Send staff to edupro social
							try
							{
								connectToEduProDB();
								
								edu_stat = conEduPro.createStatement();
								
								String dobtime = "0";
								String jointime = ""+new Date().getTime();
								jointime = jointime.substring(0, 10);
								
								String ql = "insert into ep_user(profile_page_id,server_id,user_group_id," +
										"status_id,view_id,user_name,full_name,password,password_salt,email,gender,birthday,birthday_search,country_iso," +
										"language_id,style_id,time_zone,dst_check,joined,last_login,last_activity,user_image,hide_tip,status,footer_bar," +
										"invite_user_id,im_beep,im_hide,is_invisible,total_spam,last_ip_address,feed_sort) " +
										"values(0, 0, 2, 0, 0, '" + s.getUser().getUsername() + "', '" + s.getStaff_fn() + " " + s.getStaff_mn() + " " + s.getStaff_ln() + "'," +
												"'e63a022225852cd1e5e284c57d97028b', 'TC6', '" + s.getAddress().getEmail() + "',0," +
														"'0'," + dobtime + ",'NG','en',1,'z30',0," + jointime + ",0,0,null,0,null,0,0,0,0,0,0,'',0)";
								//System.out.println(ql);
								int edu_ret = edu_stat.executeUpdate(ql);
								if(edu_ret > 0)
								{
									int edu_user_id = 0;
									resultEduPro = edu_stat.executeQuery("select last_insert_id()");
									while(resultEduPro.next())
									{
										edu_user_id = resultEduPro.getInt(1);
									}
									
									if(edu_user_id > 0)
									{
										edu_stat.executeUpdate("insert into ep_user_activity values(" + edu_user_id + ",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)");
										
										edu_stat.executeUpdate("insert into ep_user_count values(" + edu_user_id + ",0,0,0,0,0,0)");
										
										edu_stat.executeUpdate("insert into ep_user_field values(" + edu_user_id + ",null,null,null,null,0,0,0,0,0,0,0.00,0,0,0,0,null,null,0,1,null,0,null,0,0,'USD',0,0,0,0,0,0,0,0,0,null,0,0,0,null,0,null)");
										
										edu_stat.executeUpdate("insert into ep_user_space values(" + edu_user_id + ",0,0,0,0,0,0,0,0,0,0,0,0)");
										
										conEduPro.commit();
									}
									else
									{
										conEduPro.rollback();
									}
								}
								else
								{
									conEduPro.rollback();
								}
							}
							catch(Exception exEduPro)
							{
								exEduPro.printStackTrace();
							}
							finally
							{
								closeEduProConnection();
							}
							
							// send email notification out to new staff's email account
							Thread t = new Thread()
							{
								public void run()
								{
									String html = "<html><body>";
									html += "<p>Dear " + s.getStaff_fn() + "</p>";
									html += "<p>Welcome to the Bradawl community! </p>";
									html += "<p>Your access details are below: -<br/><br/>";
									html += "Username: " + s.getUser().getUsername() + "</br>";
									html += "Password: " + ramPass2 + "</br>";
									html += "</p>";
									html += "<p>Please browse to the portal to change your password after your first log in.</p>";
									html += "<p>Regards,</p>";
									html += "<p>The Bradawl Team</p>";
									html += "</body></html>";
									
									Emailer.sendEmail("team@bradawl.org", s.getAddress().getEmail(), "Welcome to Bradawl!", html);
								}
							};
							t.start();
							
							/*try
							{
								renderer.render("/email_to_staff.xhtml");
							}
							catch(Exception ex)
							{
								ex.printStackTrace();
							}*/
							
							con.commit();
						}
						else
						{
							con.rollback();
						}
					}
					else
					{
						con.commit();
					}
				}
				else
				{
					con.rollback();
				}
			}
			else
			{
				con.rollback();
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			try
			{
				con.rollback();
			}
			catch(Exception ig){}
			ret = -2;
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	public int UpdateStaff(final Staff s)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call upd_staff_sp(?,?,?,?,?,?,?,?,?,?)}");
			stored_procedure.setInt(1, s.getStaff_id());
			stored_procedure.setString(2, s.getStaff_fn());
			stored_procedure.setString(3, s.getStaff_mn());
			stored_procedure.setString(4, s.getStaff_ln());
			stored_procedure.setInt(5, s.getStaff_cat_id());
			stored_procedure.setInt(6, s.getDepartment_id());
			stored_procedure.setInt(7, s.getStatus_id());
			stored_procedure.setDate(8, new java.sql.Date(s.getDt_employed().getTime()));
			stored_procedure.setInt(9, s.getUser_id());
			stored_procedure.setInt(10, -1); // output
			
			stored_procedure.registerOutParameter(10, Types.INTEGER);
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(10);
			if(ret == 0)
			{
				stored_procedure = con.prepareCall("{call upd_address_sp(?,?,?,?,?,?,?,?,?)}");
				stored_procedure.setInt(1, s.getAddress().getAddr_id()); // addr_id
				stored_procedure.setString(2, s.getAddress().getAddr1());
				stored_procedure.setString(3, s.getAddress().getAddr2());
				stored_procedure.setString(4, s.getAddress().getPhone1());
				stored_procedure.setString(5, s.getAddress().getPhone2());
				stored_procedure.setString(6, s.getAddress().getEmail());
				stored_procedure.setString(7, s.getAddress().getFax());
				stored_procedure.setString(8, s.getAddress().getWebsite());
				stored_procedure.setInt(9, -1); // output code
				stored_procedure.registerOutParameter(9, Types.INTEGER);
				
				stored_procedure.execute();
				
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
	 * Gets staffs based on a combination of their category, department and status.
	 * */
	public ArrayList<Staff> getStaffs(int cat_id, int dept_id, int stat_id)
	{
		ArrayList<Staff> list = new ArrayList<Staff>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_staffs_sp(?, ?, ?)}");
			
			if(cat_id == 0)
				stored_procedure.setNull(1, Types.INTEGER);
			else
				stored_procedure.setInt(1, cat_id);
			
			if(dept_id == 0)
				stored_procedure.setNull(2, Types.INTEGER);
			else
				stored_procedure.setInt(2, dept_id);
			
			if(stat_id == 0)
				stored_procedure.setNull(3, Types.INTEGER);
			else
				stored_procedure.setInt(3, stat_id);
			
			result = stored_procedure.executeQuery();
			
			while(result.next())
			{
				Staff e = new Staff();
				
				e.setStaff_id(result.getInt(1));
				e.setStaff_fn(result.getString(2));
				e.setStaff_mn(result.getString(3));
				e.setStaff_ln(result.getString(4));
				e.setStaff_cat_id(result.getInt(5));
				e.setDepartment_id(result.getInt(6));
				e.setAddr_id(result.getInt(7));
				e.setStatus_id(result.getInt(8));
				e.setDt_employed(result.getDate(9));
				e.setUser_id(result.getInt(10));
				e.setCrt_dt(result.getDate(11));
				
				list.add(e);
			}
			
			for(Staff e : list)
			{
				e.setStatus_nm((e.getStaff_id() == 1) ? "Active" : "Suspended");
				
				stored_procedure = con.prepareCall("{call get_staff_cat_byid_sp(?)}");
				stored_procedure.setInt(1, e.getStaff_cat_id());
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					e.setStaff_cat_nm(result.getString(2));
				}
				
				stored_procedure = con.prepareCall("{call get_department_byid_sp(?)}");
				stored_procedure.setInt(1, e.getDepartment_id());
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					e.setDepartment_nm(result.getString(2));
				}
				
				// address
				stored_procedure = con.prepareCall("{call get_addressbyid_sp(?)}");
				stored_procedure.setInt(1, e.getAddr_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Address a = new Address();
					
					a.setAddr_id(result.getInt(1));
					a.setAddr1(result.getString(2));
					a.setAddr2(result.getString(3));
					a.setPhone1(result.getString(4));
					a.setPhone2(result.getString(5));
					a.setEmail(result.getString(6));
					a.setFax(result.getString(7));
					a.setWebsite(result.getString(8));
					
					e.setAddress(a);
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
	 * Gets staffs based on a combination of their category, department and status.
	 * */
	public ArrayList<Staff> getStaffs(int cat_id, int dept_id, int stat_id, String fn, String ln)
	{
		ArrayList<Staff> list = new ArrayList<Staff>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_staffs2_sp(?, ?, ?, ?, ?)}");
			
			if(cat_id == 0)
				stored_procedure.setNull(1, Types.INTEGER);
			else
				stored_procedure.setInt(1, cat_id);
			
			if(dept_id == 0)
				stored_procedure.setNull(2, Types.INTEGER);
			else
				stored_procedure.setInt(2, dept_id);
			
			if(stat_id == 0)
				stored_procedure.setNull(3, Types.INTEGER);
			else
				stored_procedure.setInt(3, stat_id);
			
			if(fn == null || fn.trim().length() == 0)
				stored_procedure.setNull(4, Types.VARCHAR);
			else
				stored_procedure.setString(4, fn);
			
			if(ln == null || ln.trim().length() == 0)
				stored_procedure.setNull(5, Types.VARCHAR);
			else
				stored_procedure.setString(5, ln);
			
			result = stored_procedure.executeQuery();
			
			while(result.next())
			{
				Staff e = new Staff();
				
				e.setStaff_id(result.getInt(1));
				e.setStaff_fn(result.getString(2));
				e.setStaff_mn(result.getString(3));
				e.setStaff_ln(result.getString(4));
				e.setStaff_cat_id(result.getInt(5));
				e.setDepartment_id(result.getInt(6));
				e.setAddr_id(result.getInt(7));
				e.setStatus_id(result.getInt(8));
				e.setDt_employed(result.getDate(9));
				e.setUser_id(result.getInt(10));
				e.setCrt_dt(result.getDate(11));
				
				User u = new User();
				u.setUser_id(result.getInt(12));
				u.setUsername(result.getString(13));
				
				e.setUser(u);
				
				list.add(e);
			}
			
			for(Staff e : list)
			{
				e.setStatus_nm((e.getStatus_id() == 1) ? "Active" : "Suspended");
				
				stored_procedure = con.prepareCall("{call get_staff_cat_byid_sp(?)}");
				stored_procedure.setInt(1, e.getStaff_cat_id());
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					e.setStaff_cat_nm(result.getString(2));
				}
				
				stored_procedure = con.prepareCall("{call get_department_byid_sp(?)}");
				stored_procedure.setInt(1, e.getDepartment_id());
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					e.setDepartment_nm(result.getString(2));
				}
				
				// address
				stored_procedure = con.prepareCall("{call get_addressbyid_sp(?)}");
				stored_procedure.setInt(1, e.getAddr_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Address a = new Address();
					
					a.setAddr_id(result.getInt(1));
					a.setAddr1(result.getString(2));
					a.setAddr2(result.getString(3));
					a.setPhone1(result.getString(4));
					a.setPhone2(result.getString(5));
					a.setEmail(result.getString(6));
					a.setFax(result.getString(7));
					a.setWebsite(result.getString(8));
					
					e.setAddress(a);
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
	 * Gets a staff by its id.
	 * */
	public Staff getStaffByID(int id)
	{
		Staff e = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call getStaffByID(?)}");
			stored_procedure.setInt(1, id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				e = new Staff();
				
				e.setStaff_id(result.getInt(1));
				e.setStaff_fn(result.getString(2));
				e.setStaff_mn(result.getString(3));
				e.setStaff_ln(result.getString(4));
				e.setStaff_cat_id(result.getInt(5));
				e.setDepartment_id(result.getInt(6));
				e.setAddr_id(result.getInt(7));
				e.setStatus_id(result.getInt(8));
				
				java.sql.Date dt = result.getDate(9);
				e.setDt_employed(new java.util.Date(dt.getTime()));
			}
			
			if(e != null) // now get the address
			{
				stored_procedure = con.prepareCall("{call getAddressByID(?)}");
				stored_procedure.setInt(1, e.getAddr_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Address a = new Address();
					
					a.setAddr_id(result.getInt(1));
					a.setAddr1(result.getString(2));
					a.setAddr2(result.getString(3));
					a.setPhone1(result.getString(4));
					a.setPhone2(result.getString(5));
					a.setEmail(result.getString(6));
					
					e.setAddress(a);
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
		
		return e;
	}
	
	/**
	 * Maps a staff to a subject.
	 * */
	public int MapStaffToSubject(Ref staff_sub)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_staff_subject_sp(?,?,?)}");
			stored_procedure.setInt(1, staff_sub.getId2()); // subject
			stored_procedure.setInt(2, staff_sub.getId3()); // staff
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
	 * Gets all the subjects a staff is mapped to.
	 * */
	public ArrayList<Ref> GetStaffSubjects(int staff_id)
	{
		ArrayList<Ref> list = new ArrayList<Ref>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_staff_subjects_sp(?)}");
			stored_procedure.setInt(1, staff_id);
			
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
	
	/**
	 * Gets staffs for a subject.
	 * */
	public ArrayList<Staff> GetSubjectStaffs(int sub_id)
	{
		ArrayList<Staff> list = new ArrayList<Staff>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_subject_staffs_sp(?)}");
			stored_procedure.setInt(1, sub_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Staff e = new Staff();
				
				e.setStaff_id(result.getInt(1));
				e.setStaff_fn(result.getString(2));
				e.setStaff_mn(result.getString(3));
				e.setStaff_ln(result.getString(4));
				
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
}
