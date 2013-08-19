package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import java.sql.Types;
import java.util.ArrayList;
import java.util.Date;
import java.util.Random;

import com.dexter.bradawl.dto.Address;
import com.dexter.bradawl.dto.Attendance;
import com.dexter.bradawl.dto.Guardian;
import com.dexter.bradawl.dto.Prefect;
import com.dexter.bradawl.dto.Ref;
import com.dexter.bradawl.dto.Score;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.StudentMedical;
import com.dexter.bradawl.dto.User;
import com.dexter.bradawl.security.Encrypter;
import com.dexter.bradawl.util.Emailer;
import com.dexter.bradawl.util.Env;

public class StudentModel
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
	
	public StudentModel()
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
	 * Creates a new student through the admission module.
	 * */
	public int admitStudent(Student s)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			// address
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
				
				// student
				stored_procedure = con.prepareCall("{call crt_student_sp(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}");
				stored_procedure.setString(1, s.getStudent_fn());
				stored_procedure.setString(2, s.getStudent_mn());
				stored_procedure.setString(3, s.getStudent_ln());
				stored_procedure.setInt(4, addr_id);
				stored_procedure.setString(5, s.getGender());
				stored_procedure.setDate(6, new java.sql.Date(s.getDob().getTime()));
				stored_procedure.setInt(7, s.getClass_id());
				stored_procedure.setString(8, s.getDisability());
				stored_procedure.setString(9, s.getPrecaution());
				stored_procedure.setString(10, s.getBlood_grp());
				stored_procedure.setString(11, s.getGenotype());
				stored_procedure.setDate(12, new java.sql.Date(s.getDate_enrolled().getTime()));
				stored_procedure.setInt(13, s.getRollNumber());
				stored_procedure.setInt(14, s.getHouse_id());
				stored_procedure.setString(15, s.getStudent_type());
				stored_procedure.setInt(16, s.getHostel_id());
				stored_procedure.setInt(17, s.getUser_id());
				stored_procedure.setInt(18, -1);
				stored_procedure.setInt(19, -1);
				stored_procedure.registerOutParameter(18, Types.INTEGER);
				stored_procedure.registerOutParameter(19, Types.INTEGER);
				stored_procedure.execute();
				
				ret = stored_procedure.getInt(19);
				if(ret == 0)
				{
					int student_id = stored_procedure.getInt(18);
					s.setStudent_id(student_id);
					
					// insert the student user account
					final String username = "ST"+student_id;
					String u_pass = "password";
					u_pass = Encrypter.Encrypt(u_pass); // encrypt the password
					int role_id = 8; // student role
					
					stored_procedure = con.prepareCall("{call crt_user_sp(?,?,?,?,?,?,?)}");
					stored_procedure.setString(1, username);
					stored_procedure.setString(2, u_pass);
					stored_procedure.setInt(3, role_id);
					stored_procedure.setInt(4, student_id);
					stored_procedure.setString(5, "Y");
					stored_procedure.setInt(6, -1); // user_id
					stored_procedure.setInt(7, -1); // output
					stored_procedure.registerOutParameter(6, Types.INTEGER);
					stored_procedure.registerOutParameter(7, Types.INTEGER);
					
					stored_procedure.execute();
					s.getUser().setUsername(username);
					
					// send student to edupro
					try
					{
						connectToEduProDB();
						
						edu_stat = conEduPro.createStatement();
						
						String dd = ""+s.getDob().getDate();
						String mm = ""+s.getDob().getMonth()+1;
						String yy = ""+(s.getDob().getYear()+1900);
						
						if(dd.length() == 1)
							dd = "0"+dd;
						if(mm.length() == 1)
							mm = "0"+mm;
						
						String dobtime = ""+s.getDob().getTime();
						dobtime = dobtime.substring(0, 10);
						String jointime = ""+new Date().getTime();
						jointime = jointime.substring(0, 10);
						
						String ql = "insert into ep_user(profile_page_id,server_id,user_group_id," +
								"status_id,view_id,user_name,full_name,password,password_salt,email,gender,birthday,birthday_search,country_iso," +
								"language_id,style_id,time_zone,dst_check,joined,last_login,last_activity,user_image,hide_tip,status,footer_bar," +
								"invite_user_id,im_beep,im_hide,is_invisible,total_spam,last_ip_address,feed_sort) " +
								"values(0, 0, 2, 0, 0, '" + s.getUser().getUsername() + "', '" + s.getStudent_fn() + " " + s.getStudent_mn() + " " + s.getStudent_ln() + "'," +
										"'e63a022225852cd1e5e284c57d97028b', 'TC6', '" + s.getAddress().getEmail() + "'," + (s.getGender().equalsIgnoreCase("male") ? "1" : "2") + "," +
												"'" + dd + "" + mm + "" + yy + "'," + dobtime + ",'NG','en',1,'z30',0," + jointime + ",0,0,null,0,null,0,0,0,0,0,0,'',0)";
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
					
					// guardians
					for(final Guardian g : s.getGuardians())
					{
						if(g.getGuardian_id() > 0)
						{
							stored_procedure = con.prepareCall("{call crt_student_guardian_sp(?,?,?,?,?)}");
							stored_procedure.setInt(1, student_id);
							stored_procedure.setInt(2, g.getGuardian_id());
							stored_procedure.setInt(3, g.getRelationship_id());
							stored_procedure.setInt(4, s.getUser_id());
							stored_procedure.setInt(5, -1);
							stored_procedure.registerOutParameter(5, Types.INTEGER);
							
							stored_procedure.execute();
							
							continue;
						}
						
						Address ga = g.getAddress();
						
						// address
						stored_procedure = con.prepareCall("{call crt_address_sp(?,?,?,?,?,?,?,?,?)}");
						stored_procedure.setString(1, ga.getAddr1());
						stored_procedure.setString(2, ga.getAddr2());
						stored_procedure.setString(3, ga.getPhone1());
						stored_procedure.setString(4, ga.getPhone2());
						stored_procedure.setString(5, ga.getEmail());
						stored_procedure.setString(6, ga.getFax());
						stored_procedure.setString(7, ga.getWebsite());
						stored_procedure.setInt(8, -1); // addr_id
						stored_procedure.setInt(9, -1); // output code
						stored_procedure.registerOutParameter(8, Types.INTEGER);
						stored_procedure.registerOutParameter(9, Types.INTEGER);
						
						stored_procedure.execute();
						
						int output = stored_procedure.getInt(9);
						if(output == 0)
						{
							int ga_id = stored_procedure.getInt(8);
							
							// guardian
							stored_procedure = con.prepareCall("{call crt_guardian_sp(?,?,?,?,?,?)}");
							stored_procedure.setInt(1, g.getTitle_id());
							stored_procedure.setString(2, g.getName());
							stored_procedure.setInt(3, ga_id);
							stored_procedure.setInt(4, s.getUser_id());
							stored_procedure.setInt(5, -1);
							stored_procedure.setInt(6, -1);
							stored_procedure.registerOutParameter(5, Types.INTEGER);
							stored_procedure.registerOutParameter(6, Types.INTEGER);
							
							stored_procedure.execute();
							
							output = stored_procedure.getInt(6);
							if(output == 0)
							{
								int g_id = stored_procedure.getInt(5);
								// map to student
								stored_procedure = con.prepareCall("{call crt_student_guardian_sp(?,?,?,?,?)}");
								stored_procedure.setInt(1, student_id);
								stored_procedure.setInt(2, g_id);
								stored_procedure.setInt(3, g.getRelationship_id());
								stored_procedure.setInt(4, s.getUser_id());
								stored_procedure.setInt(5, -1);
								stored_procedure.registerOutParameter(5, Types.INTEGER);
								
								stored_procedure.execute();
								
								// guardian use have a user account so, creat one here and send an email to the email account provided.
								if(g.getHasUser())
								{
									String ramPass = "password";
									
									/*for(int i=0; i<8; i++)
									{
										Random ran = new Random();
										String l = letters[ran.nextInt(letters.length)];
										ramPass = ramPass + l;
									}*/
									
									//TODO: Create guardian user here
									final String ramPass2 = ramPass;
									String gpassword = Encrypter.Encrypt(ramPass); // encrypt a random password
									
									final String gusername = "G" + g_id;
									
									stored_procedure = con.prepareCall("{call crt_user_sp(?,?,?,?,?,?,?)}");
									stored_procedure.setString(1, gusername);
									stored_procedure.setString(2, gpassword);
									stored_procedure.setInt(3, 9);
									stored_procedure.setInt(4, g_id);
									stored_procedure.setString(5, "Y");
									stored_procedure.setInt(6, -1); // user_id
									stored_procedure.setInt(7, -1); // output
									stored_procedure.registerOutParameter(6, Types.INTEGER);
									stored_procedure.registerOutParameter(7, Types.INTEGER);
									
									stored_procedure.execute();
									
									ret = stored_procedure.getInt(7);
									if(ret == 0)
									{
										//TODO Send guardian to edupro
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
													"values(0, 0, 2, 0, 0, '" + gusername + "', '" + g.getName() + "'," +
															"'e63a022225852cd1e5e284c57d97028b', 'TC6', '" + ga.getEmail() + "',0," +
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
										
										// send email notification out to new guardian's email account
										Thread t = new Thread()
										{
											public void run()
											{
												String html = "<html><body>";
												html += "<p>Dear " + g.getName() + "</p>";
												html += "<p>Welcome to the EduPro community! </p>";
												html += "<p>Your access details are below: -<br/><br/>";
												html += "Username: " + gusername + "</br>";
												html += "Password: " + ramPass2 + "</br>";
												html += "</p>";
												html += "<p>You can use the above details to access both the management portal which is at <a href=\"#\">www.edupro.edu.ng/bradawl</a> and the social media portal which is at <a href=\"#\">www.edupro.edu.ng/social</a></p>";
												html += "<p>Your child's user details are below: -<br/><br/>";
												html += "Username: " + username + "</br>";
												html += "Password: password</br>";
												html += "</p>";
												html += "<p>Please browse to the portal to change your password after your first log in.</p>";
												html += "<p>Regards,</p>";
												html += "<p>The EduPro Team</p>";
												html += "</body></html>";
												
												Emailer.sendEmail("team@edupro.edu.ng", g.getAddress().getEmail(), "Welcome to EduPro!", html);
											}
										};
										t.start();
									}
								}
							}
						}
					}
					
					// medicals
					for(StudentMedical sm : s.getMedicals())
					{
						stored_procedure = con.prepareCall("{call crt_student_medical_sp(?,?,?,?,?,?)}");
						stored_procedure.setInt(1, student_id);
						stored_procedure.setInt(2, sm.getMedical_test_id());
						stored_procedure.setInt(3, sm.getMedical_result_id());
						stored_procedure.setString(4, sm.getResult_summary());
						stored_procedure.setInt(5, s.getUser_id());
						stored_procedure.setInt(6, -1);
						stored_procedure.registerOutParameter(6, Types.INTEGER);
						
						stored_procedure.execute();
					}
					
					// clubs
					for(Ref c : s.getClubs())
					{
						stored_procedure = con.prepareCall("{call crt_student_club_sp(?,?,?,?)}");
						stored_procedure.setInt(1, student_id);
						stored_procedure.setInt(2, c.getId());
						stored_procedure.setInt(3, s.getUser_id());
						stored_procedure.setInt(4, -1);
						stored_procedure.registerOutParameter(4, Types.INTEGER);
						
						stored_procedure.execute();
					}
					
					con.commit();
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
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	/**
	 * Gets students by search.
	 * */
	public ArrayList<Student> getStudentsBySearch(Student searchBy)
	{
		ArrayList<Student> list = new ArrayList<Student>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_studentbysearch_sp(?,?,?,?,?,?,?,?)}");
			
			if(searchBy.getClass_id() == 0)
			{
				stored_procedure.setNull(1, Types.INTEGER);
			}
			else
			{
				stored_procedure.setInt(1, searchBy.getClass_id());
			}
			
			if(searchBy.getGender() != null && searchBy.getGender().trim().length() > 0)
			{
				stored_procedure.setString(2, searchBy.getGender());
			}
			else
			{
				stored_procedure.setNull(2, Types.CHAR);
			}
			
			if(searchBy.getStudent_fn() != null && searchBy.getStudent_fn().trim().length() > 0)
			{
				stored_procedure.setString(3, searchBy.getStudent_fn());
			}
			else
			{
				stored_procedure.setNull(3, Types.VARCHAR);
			}
			
			if(searchBy.getStudent_ln() != null && searchBy.getStudent_ln().trim().length() > 0)
			{
				stored_procedure.setString(4, searchBy.getStudent_ln());
			}
			else
			{
				stored_procedure.setNull(4, Types.VARCHAR);
			}
			
			if(searchBy.getRollNumber() > 0)
			{
				stored_procedure.setInt(5, searchBy.getRollNumber());
			}
			else
			{
				stored_procedure.setNull(5, Types.INTEGER);
			}
			
			if(searchBy.getHouse_id() > 0)
			{
				stored_procedure.setInt(6, searchBy.getHouse_id());
			}
			else
			{
				stored_procedure.setNull(6, Types.INTEGER);
			}
			
			if(searchBy.getStudent_type() != null && searchBy.getStudent_type().trim().length() > 0)
			{
				stored_procedure.setString(7, searchBy.getStudent_type());
			}
			else
			{
				stored_procedure.setNull(7, Types.CHAR);
			}
			
			if(searchBy.getStudent_year_enroll() != null && searchBy.getStudent_year_enroll().trim().length() > 0)
			{
				stored_procedure.setString(8, searchBy.getStudent_year_enroll());
			}
			else
			{
				stored_procedure.setNull(8, Types.CHAR);
			}
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Student e = new Student();
				
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setAddr_id(result.getInt(5));
				e.setGender(result.getString(6));
				e.setDob(result.getDate(7));
				e.setClass_id(result.getInt(8));
				e.setDisability(result.getString(9));
				e.setPrecaution(result.getString(10));
				e.setBlood_grp(result.getString(11));
				e.setGenotype(result.getString(12));
				e.setDate_enrolled(result.getDate(13));
				e.setUser_id(result.getInt(14));
				e.setCrt_dt(result.getDate(15));
				e.setStudent_status_id(result.getInt(16));
				e.setYear_graduated(result.getInt(17));
				e.setRollNumber(result.getInt(18));
				e.setStudent_type(result.getString(19));
				e.setHouse_id(result.getInt(20));
				e.setCurClass_id(result.getInt(21));
				
				User u = new User();
				u.setUser_id(result.getInt(22));
				u.setUsername(result.getString(23));
				
				e.setUser(u);
				
				list.add(e);
			}
			
			// now we get other details, medicals, address, and so on
			for(Student e : list)
			{
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
				
				stored_procedure = con.prepareCall("{call get_studentguardians_sp(?)}");
				stored_procedure.setInt(1, e.getStudent_id());
				
				result = stored_procedure.executeQuery();
				ArrayList<String[]> gs = new ArrayList<String[]>();
				while(result.next())
				{
					String[] sg = new String[4];
					sg[0] = result.getString(1); // student_guardian_id
					sg[1] = result.getString(2); // student_id
					sg[2] = result.getString(3); // guardian_id
					sg[3] = result.getString(4); // relationship_id
					
					gs.add(sg);
				}
				
				for(String[] sg : gs)
				{
					stored_procedure = con.prepareCall("{call get_guardianbyid_sp(?)}");
					stored_procedure.setInt(1, Integer.parseInt(sg[2]));
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						Guardian g = new Guardian();
						
						g.setGuardian_id(result.getInt(1));
						g.setTitle_id(result.getInt(2));
						g.setName(result.getString(3));
						g.getAddress().setAddr_id(result.getInt(4));
						g.setUser_id(result.getInt(5));
						g.setCrt_dt(result.getDate(6));
						g.setRelationship_id(Integer.parseInt(sg[3]));
						
						e.getGuardians().add(g);
					}
				}
				
				for(Guardian g : e.getGuardians())
				{
					// address
					stored_procedure = con.prepareCall("{call get_addressbyid_sp(?)}");
					stored_procedure.setInt(1, g.getAddress().getAddr_id());
					
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
						
						g.setAddress(a);
					}
				}
				
				stored_procedure = con.prepareCall("{call get_student_medicals_sp(?)}");
				stored_procedure.setInt(1, e.getStudent_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					StudentMedical sm = new StudentMedical();
					
					sm.setId(result.getInt(1));
					sm.setStudent_id(result.getInt(2));
					sm.setMedical_test_id(result.getInt(3));
					sm.setMedical_result_id(result.getInt(4));
					sm.setResult_summary(result.getString(5));
					sm.setUser_id(result.getInt(6));
					sm.setCrt_dt(result.getDate(7));
					
					e.getMedicals().add(sm);
				}
				
				stored_procedure = con.prepareCall("{call get_student_clubs_sp(?)}");
				stored_procedure.setInt(1, e.getStudent_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Ref club = new Ref();
					
					club.setId(result.getInt(3));
					club.setName(result.getString(4));
					club.setDesc(result.getString(5));
					
					e.getClubs().add(club);
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
	 * Gets students for a guardian.
	 * */
	public ArrayList<Student> getGuardianStudents(int guardian_id)
	{
		ArrayList<Student> list = new ArrayList<Student>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_guardianstudents_sp(?)}");
			
			stored_procedure.setInt(1, guardian_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Student e = new Student();
				
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setAddr_id(result.getInt(5));
				e.setGender(result.getString(6));
				e.setDob(result.getDate(7));
				e.setClass_id(result.getInt(8));
				e.setDisability(result.getString(9));
				e.setPrecaution(result.getString(10));
				e.setBlood_grp(result.getString(11));
				e.setGenotype(result.getString(12));
				e.setDate_enrolled(result.getDate(13));
				e.setUser_id(result.getInt(14));
				e.setCrt_dt(result.getDate(15));
				e.setStudent_status_id(result.getInt(16));
				e.setYear_graduated(result.getInt(17));
				e.setRollNumber(result.getInt(18));
				e.setStudent_type(result.getString(19));
				e.setHouse_id(result.getInt(20));
				e.setCurClass_id(result.getInt(21));
				
				list.add(e);
			}
			
			// now we get other details, medicals, address, and so on
			for(Student e : list)
			{
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
				
				stored_procedure = con.prepareCall("{call get_studentguardians_sp(?)}");
				stored_procedure.setInt(1, e.getStudent_id());
				
				result = stored_procedure.executeQuery();
				ArrayList<String[]> gs = new ArrayList<String[]>();
				while(result.next())
				{
					String[] sg = new String[4];
					sg[0] = result.getString(1); // student_guardian_id
					sg[1] = result.getString(2); // student_id
					sg[2] = result.getString(3); // guardian_id
					sg[3] = result.getString(4); // relationship_id
					
					gs.add(sg);
				}
				
				for(String[] sg : gs)
				{
					stored_procedure = con.prepareCall("{call get_guardianbyid_sp(?)}");
					stored_procedure.setInt(1, Integer.parseInt(sg[2]));
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						Guardian g = new Guardian();
						
						g.setGuardian_id(result.getInt(1));
						g.setTitle_id(result.getInt(2));
						g.setName(result.getString(3));
						g.getAddress().setAddr_id(result.getInt(4));
						g.setUser_id(result.getInt(5));
						g.setCrt_dt(result.getDate(6));
						g.setRelationship_id(Integer.parseInt(sg[3]));
						
						e.getGuardians().add(g);
					}
				}
				
				for(Guardian g : e.getGuardians())
				{
					// address
					stored_procedure = con.prepareCall("{call get_addressbyid_sp(?)}");
					stored_procedure.setInt(1, g.getAddress().getAddr_id());
					
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
						
						g.setAddress(a);
					}
				}
				
				stored_procedure = con.prepareCall("{call get_student_medicals_sp(?)}");
				stored_procedure.setInt(1, e.getStudent_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					StudentMedical sm = new StudentMedical();
					
					sm.setId(result.getInt(1));
					sm.setStudent_id(result.getInt(2));
					sm.setMedical_test_id(result.getInt(3));
					sm.setMedical_result_id(result.getInt(4));
					sm.setResult_summary(result.getString(5));
					sm.setUser_id(result.getInt(6));
					sm.setCrt_dt(result.getDate(7));
					
					e.getMedicals().add(sm);
				}
				
				stored_procedure = con.prepareCall("{call get_student_clubs_sp(?)}");
				stored_procedure.setInt(1, e.getStudent_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					Ref club = new Ref();
					
					club.setId(result.getInt(3));
					club.setName(result.getString(4));
					club.setDesc(result.getString(5));
					
					e.getClubs().add(club);
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
	 * Gets a student by its id.
	 * */
	public Student getStudentByID(int id)
	{
		Student e = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call getStudentByID(?)}");
			stored_procedure.setInt(1, id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				e = new Student();
				
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setAddr_id(result.getInt(5));
				e.setGender(result.getString(6));
				
				java.sql.Date dt = result.getDate(7);
				e.setDob(new java.util.Date(dt.getTime()));
				
				e.setClass_id(result.getInt(8));
				e.setDisability(result.getString(9));
				e.setPrecaution(result.getString(10));
				e.setBlood_grp(result.getString(11));
				e.setGenotype(result.getString(12));
				
				dt = result.getDate(13);
				e.setDate_enrolled(new java.util.Date(dt.getTime()));
				
				e.setStudent_status_id(result.getInt(16));
				e.setYear_graduated(result.getInt(17));
				e.setRollNumber(result.getInt(18));
				
				e.setCurClass_id(result.getInt(19));
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
	 * Gets all students mapped to a class.
	 * */
	public ArrayList<Attendance> GetClassStudents(int class_id, int session_id)
	{
		ArrayList<Attendance> list = new ArrayList<Attendance>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_class_students_sp(?,?)}");
			stored_procedure.setInt(1, class_id);
			stored_procedure.setInt(2, session_id);
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Attendance e = new Attendance();
				// cs.student_id, student_fn, student_mn, student_ln, rollNumber
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setRollNumber(result.getInt(5));
				
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
	
	public Ref GetStudentSessionClass(int student_id, int session_id)
	{
		Ref e = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_studentsessionclass_sp(?,?)}");
			stored_procedure.setInt(1, student_id);
			stored_procedure.setInt(2, session_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				e = new Ref();
				e.setId(result.getInt(1));
				e.setName(result.getString(2));
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
	 * Maps students to a class
	 * */
	public String mapStudentToClass(ArrayList<Attendance> students, int class_id)
	{
		String ret = "";
		
		try
		{
			connectToDB();
			
			int failedCnt = 0;
			for(Attendance s : students)
			{
				if(s.getFlagBool())
				{
					stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
					stored_procedure.setInt(1, class_id);
					stored_procedure.setInt(2, s.getStudent_id());
					stored_procedure.setInt(3, 0);
					stored_procedure.setInt(4, -1);
					stored_procedure.registerOutParameter(4, Types.INTEGER);
					
					stored_procedure.execute();
					
					if(stored_procedure.getInt(4) > 0)
						failedCnt++;
				}
			}
			
			con.commit();
			
			if(failedCnt > 0)
				ret = failedCnt + " mappings failed";
			else
				ret = "All students were mapped successfully";
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			ret = "Server error occured: " + ex.getMessage();
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	public ArrayList<Score> getStudentSessionSubsScores(int session_id, int student_id, int sub_id)
	{
		ArrayList<Score> list = new ArrayList<Score>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_subject_ses_scores_sp(?,?,?)}");
			stored_procedure.setInt(1, session_id);
			stored_procedure.setInt(2, sub_id);
			stored_procedure.setInt(3, student_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				// student_score_id, ss.sub_id, sub_nm, student_id, test_score, exam_score, attendance_score, grade_id, ss.term_id, term_nm, s.session_id, session_nm, ss.user_id, ss.crt_dt
				Score e = new Score();
				
				e.setSub_id(result.getInt(2));
				e.setSub_nm(result.getString(3));
				e.setTest_score(result.getDouble(5));
				e.setExam_score(result.getDouble(6));
				e.setAttendance_score(result.getDouble(7));
				e.setGrade_id(result.getInt(8));
				e.setTerm_id(result.getInt(9));
				e.setTerm_nm(result.getString(10));
				e.setSession_nm(result.getString(12));
				
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
	
	public Guardian getGuardian(int id)
	{
		Guardian g = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_guardianbyid_sp(?)}");
			stored_procedure.setInt(1, id);
			
			result = stored_procedure.executeQuery();
			int addr_id = 0;
			while(result.next())
			{
				g = new Guardian();
				
				// guardian_id, title_id, [name], addr_id, [user_id], crt_dt
				g.setGuardian_id(result.getInt(1));
				g.setTitle_id(result.getInt(2));
				g.setName(result.getString(3));
				addr_id = result.getInt(4);
			}
			
			if(g != null && addr_id > 0)
			{
				stored_procedure = con.prepareCall("{call getAddressByID(?)}");
				stored_procedure.setInt(1, addr_id);
				
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
					
					g.setAddress(a);
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
		
		return g;
	}
	
	public ArrayList<Guardian> searchGuardians(String name)
	{
		ArrayList<Guardian> list = new ArrayList<Guardian>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call search_guardianbyname_sp(?)}");
			stored_procedure.setString(1, name);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Guardian g = new Guardian();
				
				// guardian_id, title_id, [name], addr_id, [user_id], crt_dt
				g.setGuardian_id(result.getInt(1));
				g.setTitle_id(result.getInt(2));
				g.setName(result.getString(3));
				int addr_id = result.getInt(4);
				
				Address a = new Address();
				a.setAddr_id(addr_id);
				g.setAddress(a);
				
				User u = new User();
				u.setUser_id(result.getInt(7));
				u.setUsername(result.getString(8));
				
				g.setUser(u);
				
				list.add(g);
			}
			
			for(Guardian g : list)
			{
				if(g != null && g.getAddress().getAddr_id() > 0)
				{
					stored_procedure = con.prepareCall("{call getAddressByID(?)}");
					stored_procedure.setInt(1, g.getAddress().getAddr_id());
					
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
						
						g.setAddress(a);
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
	 * Assigns a prefect role to a student.
	 * */
	public int AssignPrefect(Prefect p)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_session_prefect_sp(?,?,?,?,?,?)}");
			stored_procedure.setInt(1, p.getSession_id());
			stored_procedure.setInt(2, p.getStudent_id());
			stored_procedure.setInt(3, p.getPrefect_id());
			stored_procedure.setString(4, p.getType());
			stored_procedure.setInt(5, p.getUser_id());
			stored_procedure.setInt(6, -1);
			stored_procedure.registerOutParameter(6, Types.INTEGER);
			
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(6);
			
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
	 * Gets prefectships for a session.
	 * */
	public ArrayList<Prefect> GetSessionPrefects(int session_id)
	{
		ArrayList<Prefect> list = new ArrayList<Prefect>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_session_prefects_sp(?)}");
			stored_procedure.setInt(1, session_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Prefect e = new Prefect();
				
				e.setId(result.getInt(1));
				e.setSession_id(result.getInt(2));
				e.setStudent_id(result.getInt(3));
				e.setPrefect_id(result.getInt(4));
				e.setType(result.getString(5));
				e.setUser_id(result.getInt(6));
				e.setCrt_dt(result.getDate(7));
				
				e.setSession_nm(result.getString(8));
				
				Student st = new Student();
				st.setStudent_id(e.getStudent_id());
				st.setStudent_fn(result.getString(9));
				st.setStudent_mn(result.getString(10));
				st.setStudent_ln(result.getString(11));
				
				e.setStudent(st);
				
				e.setPrefect_nm(result.getString(12));
				
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
