package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.ArrayList;
import java.util.Calendar;

import com.dexter.bradawl.dto.Attendance;
import com.dexter.bradawl.dto.Session;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.Term;
import com.dexter.bradawl.util.Env;

public class SessionModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public SessionModel()
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
	 * Starts a new academic session
	 * */
	public int StartNewSession(Session newsession, int user_id)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			// first we have to create the session
			stored_procedure = con.prepareCall("{call start_session_sp(?,?,?,?)}");
			stored_procedure.setString(1, newsession.getSession_nm());
			stored_procedure.setDate(2, new java.sql.Date(newsession.getSession_st_dt().getTime()));
			stored_procedure.setInt(3, user_id);
			stored_procedure.setInt(4, -1);
			stored_procedure.registerOutParameter(4, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(4);
			
			switch(ret)
			{
				case 0:
				{
					con.commit();
					
					// since session creation was successful, we have to do all other things required for a new session
					// move students to their new classes and also graduate previous sss 3 students
					// the grading should have been done from the start_session_sp procedure and also the 1st term of the session would have been inserted
					
					PromoteStudents();
					
					break;
				}
				case 1:
				{
					con.rollback();
					break;
				}
				case 2:
				{
					con.rollback();
					break;
				}
				case 3:
				{
					con.rollback();
					break;
				}
				default:
				{
					con.rollback();
					break;
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
		
		return ret;
	}
	
	/**
	 * Promotes students on a new session start
	 * */
	private void PromoteStudents()
	{
		ArrayList<com.dexter.bradawl.dto.Class> classes = new RefModel().getClasses();
		for(com.dexter.bradawl.dto.Class c : classes)
		{
			ArrayList<Attendance> students = new StudentModel().GetClassStudents(c.getClass_id(), -1);
			if(students.size() > 0)
			{
				int class_level_number = c.getLevel_num();
				String class_level = c.getClass_level();
				
				switch(class_level_number)
				{
					case 1: case 2: // both class level 1 and 2
					{
						if(class_level.equalsIgnoreCase("Primary") || class_level.equalsIgnoreCase("JSS") || class_level.equalsIgnoreCase("SSS")) // JSS/SSS 1/2 students should move to JSS/SSS 2/3 with the same class group, e.g, A, B, C, D, . . .
						{
							for(Attendance s : students)
							{
								boolean promoted = false;
								
								try
								{
									connectToDB();
									
									stored_procedure = con.prepareCall("{call get_student_session_result_sp(?,?)}");
									stored_procedure.setInt(1, s.getStudent_id());
									stored_procedure.setInt(2, -1);
									
									result = stored_procedure.executeQuery();
									while(result.next())
									{
										try
										{
											if(result.getString(4).equalsIgnoreCase("P"))
											{
												promoted = true;
											}
										}
										catch(Exception ig)
										{
											promoted = false;
										}
									}
									
									if(promoted) // promoted
									{
										int class_id = 0;
										
										// now get the id of the new class
										stored_procedure = con.prepareCall("{call get_class_sp(?,?,?)}");
										stored_procedure.setString(1, class_level);
										stored_procedure.setInt(2, class_level_number+1); // increase her level
										stored_procedure.setString(3, c.getClass_group());
										
										result = stored_procedure.executeQuery();
										while(result.next())
										{
											class_id = result.getInt(1);
										}
										
										stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
										stored_procedure.setInt(1, class_id);
										stored_procedure.setInt(2, s.getStudent_id());
										stored_procedure.setInt(3, 0);
										stored_procedure.setInt(4, -1);
										stored_procedure.registerOutParameter(4, Types.INTEGER);
										
										stored_procedure.execute();
									}
									else
									{
										stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
										stored_procedure.setInt(1, c.getClass_id());
										stored_procedure.setInt(2, s.getStudent_id());
										stored_procedure.setInt(3, 0);
										stored_procedure.setInt(4, -1);
										stored_procedure.registerOutParameter(4, Types.INTEGER);
										
										stored_procedure.execute();
									}
									
									con.commit();
								}
								catch(Exception ex)
								{}
								finally
								{
									closeConnection();
								}
							}
						}
						
						break;
					}
					case 3:
					{
						if(class_level.equalsIgnoreCase("Primary"))
						{
							for(Attendance s : students)
							{
								boolean promoted = false;
								
								try
								{
									connectToDB();
									
									stored_procedure = con.prepareCall("{call get_student_session_result_sp(?,?)}");
									stored_procedure.setInt(1, s.getStudent_id());
									stored_procedure.setInt(2, -1);
									
									result = stored_procedure.executeQuery();
									while(result.next())
									{
										try
										{
											if(result.getString(4).equalsIgnoreCase("P"))
											{
												promoted = true;
											}
										}
										catch(Exception ig)
										{
											promoted = false;
										}
									}
									
									if(promoted) // promoted
									{
										int class_id = 0;
										
										// now get the id of the new class
										stored_procedure = con.prepareCall("{call get_class_sp(?,?,?)}");
										stored_procedure.setString(1, class_level);
										stored_procedure.setInt(2, class_level_number+1); // increase her level
										stored_procedure.setString(3, c.getClass_group());
										
										result = stored_procedure.executeQuery();
										while(result.next())
										{
											class_id = result.getInt(1);
										}
										
										stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
										stored_procedure.setInt(1, class_id);
										stored_procedure.setInt(2, s.getStudent_id());
										stored_procedure.setInt(3, 0);
										stored_procedure.setInt(4, -1);
										stored_procedure.registerOutParameter(4, Types.INTEGER);
										
										stored_procedure.execute();
									}
									else
									{
										stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
										stored_procedure.setInt(1, c.getClass_id());
										stored_procedure.setInt(2, s.getStudent_id());
										stored_procedure.setInt(3, 0);
										stored_procedure.setInt(4, -1);
										stored_procedure.registerOutParameter(4, Types.INTEGER);
										
										stored_procedure.execute();
									}
									
									con.commit();
								}
								catch(Exception ex)
								{}
								finally
								{
									closeConnection();
								}
							}
						}
						else if(class_level.equalsIgnoreCase("JSS"))
						{
							// this students should move to SSS 1 if they passed their exams.
							// this would be done manually by the application manager.
						}
						else if(class_level.equalsIgnoreCase("SSS"))
						{
							for(Attendance s : students)
							{
								// update student's status to signify graduated
								try
								{
									connectToDB();
									
									stored_procedure = con.prepareCall("{call grad_student_sp(?,?,?)}");
									stored_procedure.setInt(1, s.getStudent_id());
									stored_procedure.setInt(2, Calendar.getInstance().get(Calendar.YEAR));
									stored_procedure.setInt(3, -1);
									stored_procedure.registerOutParameter(3, Types.INTEGER);
									
									stored_procedure.execute();
									
									con.commit();
								}
								catch(Exception ex)
								{}
								finally
								{
									closeConnection();
								}
							}
						}
						
						break;
					}
					case 4: case 5:
					{
						if(class_level.equalsIgnoreCase("Primary"))
						{
							for(Attendance s : students)
							{
								boolean promoted = false;
								
								try
								{
									connectToDB();
									
									stored_procedure = con.prepareCall("{call get_student_session_result_sp(?,?)}");
									stored_procedure.setInt(1, s.getStudent_id());
									stored_procedure.setInt(2, -1);
									
									result = stored_procedure.executeQuery();
									while(result.next())
									{
										try
										{
											if(result.getString(4).equalsIgnoreCase("P"))
											{
												promoted = true;
											}
										}
										catch(Exception ig)
										{
											promoted = false;
										}
									}
									
									if(promoted) // promoted
									{
										int class_id = 0;
										
										// now get the id of the new class
										stored_procedure = con.prepareCall("{call get_class_sp(?,?,?)}");
										stored_procedure.setString(1, class_level);
										stored_procedure.setInt(2, class_level_number+1); // increase her level
										stored_procedure.setString(3, c.getClass_group());
										
										result = stored_procedure.executeQuery();
										while(result.next())
										{
											class_id = result.getInt(1);
										}
										
										stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
										stored_procedure.setInt(1, class_id);
										stored_procedure.setInt(2, s.getStudent_id());
										stored_procedure.setInt(3, 0);
										stored_procedure.setInt(4, -1);
										stored_procedure.registerOutParameter(4, Types.INTEGER);
										
										stored_procedure.execute();
									}
									else
									{
										stored_procedure = con.prepareCall("{call crt_class_student_sp(?,?,?,?)}");
										stored_procedure.setInt(1, c.getClass_id());
										stored_procedure.setInt(2, s.getStudent_id());
										stored_procedure.setInt(3, 0);
										stored_procedure.setInt(4, -1);
										stored_procedure.registerOutParameter(4, Types.INTEGER);
										
										stored_procedure.execute();
									}
									
									con.commit();
								}
								catch(Exception ex)
								{}
								finally
								{
									closeConnection();
								}
							}
						}
					}
					case 6:
					{
						if(class_level.equalsIgnoreCase("Primary"))
						{
							// this students should move to JSS 1 if they passed their exams.
							// this would be done manually by the application manager.
						}
					}
				}
			}
		}
	}
	
	/**
	 * Returns the current session
	 * */
	public Session GetCurrentSession()
	{
		Session e = null;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_cursession_sp}");
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				e = new Session();
				
				e.setSession_id(result.getInt(1));
				e.setSession_nm(result.getString(2));
				e.setSession_st_dt(result.getDate(3));
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
	
	public ArrayList<Session> getAllSession()
	{
		ArrayList<Session> list = new ArrayList<Session>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_sessions_sp}");
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Session e = new Session();
				
				e.setSession_id(result.getInt(1));
				e.setSession_nm(result.getString(2));
				e.setSession_st_dt(result.getDate(3));
				
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
	 * Get session terms
	 * */
	public ArrayList<Term> GetSessionTerms(int session_id)
	{
		ArrayList<Term> list = new ArrayList<Term>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_sessionterms_sp(?)}");
			stored_procedure.setInt(1, session_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Term t = new Term();
				
				t.setTerm_id(result.getInt(1));
				t.setTerm_nm(result.getString(2));
				t.setSession_id(result.getInt(3));
				t.setTerm_st_dt(result.getDate(4));
				t.setTerm_end_dt(result.getDate(5));
				t.setCrt_dt(result.getDate(6));
				
				list.add(t);
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
	 * Starts a new term.
	 * */
	public int StartNewTerm(Term term, int user_id)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call start_term_sp(?, ?, ?, ?, ?)}");
			stored_procedure.setString(1, term.getTerm_nm());
			stored_procedure.setDate(2, new java.sql.Date(term.getTerm_st_dt().getTime()));
			if(term.getTerm_end_dt() == null)
			{
				stored_procedure.setNull(3, Types.TIMESTAMP);
			}
			else
			{
				stored_procedure.setDate(4, new java.sql.Date(term.getTerm_end_dt().getTime()));
			}
			stored_procedure.setInt(4, user_id);
			stored_procedure.setInt(5, -1);
			stored_procedure.registerOutParameter(5, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(5);
			
			switch(ret)
			{
				case 0:
				{
					con.commit();
					break;
				}
				default:
				{
					con.rollback();
					break;
				}
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			ret = -2;
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
	
	public int UpdateTerm(Term term, int user_id)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_term_sp(?, ?, ?)}");
			stored_procedure.setInt(1, term.getTerm_id());
			stored_procedure.setDate(2, new java.sql.Date(term.getTerm_end_dt().getTime()));
			stored_procedure.setInt(3, -1);
			stored_procedure.registerOutParameter(3, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(3);
			
			switch(ret)
			{
				case 0:
				{
					con.commit();
					break;
				}
				default:
				{
					con.rollback();
					break;
				}
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			ret = -2;
		}
		finally
		{
			closeConnection();
		}
		
		return ret;
	}
}
