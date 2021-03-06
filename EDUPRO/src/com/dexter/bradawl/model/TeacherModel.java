package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.ArrayList;
import java.util.Date;

import com.dexter.bradawl.dto.Attendance;
import com.dexter.bradawl.dto.ClassSubject;
import com.dexter.bradawl.dto.Grade;
import com.dexter.bradawl.dto.Grading;
import com.dexter.bradawl.dto.Result;
import com.dexter.bradawl.dto.Score;
import com.dexter.bradawl.dto.Student;
import com.dexter.bradawl.dto.Term;
import com.dexter.bradawl.dto.TermResult;
import com.dexter.bradawl.util.Env;

public class TeacherModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public TeacherModel()
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
	 * Marks students attendance
	 * */
	public int MarkAttendance(Attendance a, Date dt, int user_id)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_student_attendance_sp(?,?,?,?,?)}");
			stored_procedure.setInt(1, a.getStudent_id());
			stored_procedure.setDate(2, new java.sql.Date(dt.getTime()));
			
			if(a.getFlagBool())
				stored_procedure.setString(3, "1");
			else
				stored_procedure.setString(3, "0");
			
			stored_procedure.setInt(4, user_id);
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
	 * Marks students subject attendance
	 * */
	public int MarkStudentSubjectAttendance(Attendance a, Date dt, int user_id)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_student_subject_attendance_sp(?,?,?,?,?,?)}");
			stored_procedure.setInt(1, a.getStudent_id());
			stored_procedure.setInt(2, a.getSubject_id());
			stored_procedure.setDate(3, new java.sql.Date(dt.getTime()));
			
			if(a.getFlagBool())
				stored_procedure.setString(4, "1");
			else
				stored_procedure.setString(4, "0");
			
			stored_procedure.setInt(5, user_id);
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
	
	public ArrayList<Attendance> GetClassAttendance(int class_id, Date date)
	{
		ArrayList<Attendance> list = new ArrayList<Attendance>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_class_students_sp(?,?)}");
			stored_procedure.setInt(1, class_id);
			stored_procedure.setInt(2, 0);
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
			
			stored_procedure = con.prepareCall("{call get_student_attendance_sp(?, ?)}");
			java.sql.Date dt = new java.sql.Date(date.getTime());
			
			for(Attendance a : list)
			{
				stored_procedure.setInt(1, a.getStudent_id());
				stored_procedure.setDate(2, dt);
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					a.setFlag(result.getString(6));
					if(a.getFlag().equals("1"))
						a.setFlagBool(true);
					else
						a.setFlagBool(false);
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
	
	public ArrayList<Attendance> GetStudentClassAttendance(int id, Date d1, Date d2)
	{
		ArrayList<Attendance> list = new ArrayList<Attendance>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_attendance2_sp(?,?,?)}");
			stored_procedure.setInt(1, id);
			java.sql.Date dt = new java.sql.Date(d1.getTime());
			java.sql.Date dt2 = new java.sql.Date(d2.getTime());
			stored_procedure.setDate(2, dt);
			stored_procedure.setDate(3, dt2);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				// student_attendance_id, session_id, term_id, student_id, [curDate], flag, [user_id], crt_dt
				Attendance e = new Attendance();
				e.setId(result.getInt(1));
				e.setStudent_id(result.getInt(4));
				e.setDate(result.getDate(5));
				e.setFlag(result.getString(6));
				if(e.getFlag().equals("1"))
					e.setFlagBool(true);
				else
					e.setFlagBool(false);
				
				e.setClass_nm(result.getString(10));
				e.setClass_teacher_nm(result.getString(12));
				
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
	
	public ArrayList<Attendance> GetStudentSubjectAttendance(int student_id, int sub_id, Date d1, Date d2)
	{
		ArrayList<Attendance> list = new ArrayList<Attendance>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_student_subject_attendance_sp(?,?,?,?)}");
			stored_procedure.setInt(1, student_id);
			stored_procedure.setInt(2, sub_id);
			java.sql.Date dt = new java.sql.Date(d1.getTime());
			java.sql.Date dt2 = new java.sql.Date(d2.getTime());
			stored_procedure.setDate(3, dt);
			stored_procedure.setDate(4, dt2);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				// student_subject_attendance_id, session_id, term_id, student_id, ssa.sub_id, [curDate], flag, [user_id], crt_dt, sub_nm
				Attendance e = new Attendance();
				e.setId(result.getInt(1));
				e.setStudent_id(result.getInt(4));
				e.setSubject_id(result.getInt(5));
				
				e.setDate(result.getDate(6));
				e.setFlag(result.getString(7));
				if(e.getFlag().equals("1"))
					e.setFlagBool(true);
				else
					e.setFlagBool(false);
				e.setSubject_nm(result.getString(10));
				
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
	
	public int UpdateAttendance(Attendance a, Date dt, int user_id)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_student_attendance_sp(?,?,?,?,?)}");
			stored_procedure.setInt(1, a.getStudent_id());
			stored_procedure.setDate(2, new java.sql.Date(dt.getTime()));
			
			if(a.getFlagBool())
				stored_procedure.setString(3, "1");
			else
				stored_procedure.setString(3, "0");
			
			stored_procedure.setInt(4, user_id);
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
	 * Gets class students
	 * */
	public ArrayList<Score> GetClassStudentsAsScore(int class_id)
	{
		ArrayList<Score> list = new ArrayList<Score>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_class_students_sp(?,?)}");
			stored_procedure.setInt(1, class_id);
			stored_procedure.setInt(2, 0);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Score e = new Score();
				
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
	
	/**
	 * Inserts a student's score.
	 * */
	public int InsertScore(Score e)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_student_score_sp(?,?,?,?,?,?)}");
			stored_procedure.setInt(1, e.getSub_id());
			stored_procedure.setInt(2, e.getStudent_id());
			stored_procedure.setString(3, e.getType());
			
			if(e.getType().equalsIgnoreCase("t"))
				stored_procedure.setDouble(4, e.getTest_score());
			else
				stored_procedure.setDouble(4, e.getExam_score());
			
			stored_procedure.setInt(5, e.getUser_id());
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
	 * Gets class students scores for a subject
	 * */
	public ArrayList<Score> GetClassStudentsAndScores(int class_id, int sub_id, int term_id)
	{
		ArrayList<Score> list = new ArrayList<Score>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_class_students_subject_scores_sp(?,?,?)}");
			
			stored_procedure.setInt(1, class_id);
			stored_procedure.setInt(2, sub_id);
			stored_procedure.setInt(3, term_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Score e = new Score();
				
				// cs.student_id, student_fn, student_mn, student_ln, rollNumber, student_score_id, test_score, exam_score, attendance_score
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setRollNumber(result.getInt(5));
				
				e.setTest_score(result.getDouble(7));
				e.setExam_score(result.getDouble(8));
				e.setAttendance_score(result.getDouble(9));
				e.setTotal_score(e.getAttendance_score()+e.getTest_score()+e.getExam_score());
				
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
	 * Gets class student scores for all subjects offered by the class
	 * */
	public ArrayList<Score> GetClassStudentSubjectsScores(int class_id, int student_id, int term_id)
	{
		ArrayList<Score> list = new ArrayList<Score>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_class_student_subject_scores_sp(?,?,?)}");
			
			stored_procedure.setInt(1, class_id);
			stored_procedure.setInt(2, student_id);
			stored_procedure.setInt(3, term_id);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				Score e = new Score();
				
				// cs.student_id, student_fn, student_mn, student_ln, rollNumber, student_score_id, test_score, exam_score, attendance_score, ss.sub_id, su.sub_nm, su.sub_desc
				e.setStudent_id(result.getInt(1));
				e.setStudent_fn(result.getString(2));
				e.setStudent_mn(result.getString(3));
				e.setStudent_ln(result.getString(4));
				e.setRollNumber(result.getInt(5));
				
				e.setTest_score(result.getDouble(7));
				e.setExam_score(result.getDouble(8));
				e.setAttendance_score(result.getDouble(9));
				e.setSub_id(result.getInt(10));
				e.setSub_nm(result.getString(11));
				e.setSub_desc(result.getString(12));
				
				e.setTotal_score(e.getAttendance_score()+e.getTest_score()+e.getExam_score());
				
				Grade g = GetScoreGrade(e.getTotal_score());
				if(g != null)
				{
					e.setGrade_id(g.getGrade_id());
					e.setGrade(g);
				}
				
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
	 * Updates a student's score.
	 * */
	public int UpdateScore(Score e)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_student_scores_sp(?,?,?,?,?,?)}");
			stored_procedure.setInt(1, e.getSub_id());
			stored_procedure.setInt(2, e.getStudent_id());
			stored_procedure.setDouble(3, e.getTest_score());
			stored_procedure.setDouble(4, e.getExam_score());
			stored_procedure.setInt(5, e.getUser_id());
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
	
	public Grade GetScoreGrade(double score)
	{
		Grade g = null;
		
		ArrayList<Grade> list = new RefModel().getGrades();
		for(Grade grade : list)
		{
			if(score <= grade.getGrade_end())
			// if(grade.getGrade_start() <= score && grade.getGrade_end() >= score)
			{
				g = grade;
				break;
			}
		}
		
		return g;
	}
	
	/**
	 * Generates a term result for a class.
	 * */
	public int GenerateClassTermResult(int class_id, Term term, int user_id, Grading grading)
	{
		int ret = 0;
		
		int term_id = term.getTerm_id();
		
		// first we get all the students in the class
		Student searchBy = new Student();
		searchBy.setClass_id(class_id);
		ArrayList<Student> students = new StudentModel().getStudentsBySearch(searchBy);
		ArrayList<ClassSubject> subjects = new RefModel().GetClassSubjects(class_id);
		
		for(Student st : students)
		{
			boolean pass = true;
			
			for(ClassSubject sub : subjects)
			{
				//TODO: Simply add student id to the method call below so I don't have to do a score iteration again.
				ArrayList<Score> allStudentsScores = GetClassStudentsAndScores(class_id, sub.getSub_id(), term_id);
				boolean score_found = false;
				for(Score score : allStudentsScores)
				{
					if(score.getStudent_id() == st.getStudent_id())
					{
						double attendance_score = 0;
						
						try
						{
							connectToDB();
							
							stored_procedure = con.prepareCall("{call get_student_subject_attendance_score_sp(?, ?, ?)}");
							stored_procedure.setInt(1, st.getStudent_id());
							stored_procedure.setInt(2, sub.getSub_id());
							stored_procedure.setInt(3, term_id);
							
							result = stored_procedure.executeQuery();
							while(result.next())
							{
								attendance_score = result.getDouble(1);
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
						
						try
						{
							attendance_score = (attendance_score/grading.getAttendance())*100;
						}
						catch(Exception ig){}
						
						double tTotalScore = attendance_score + score.getTest_score() + score.getExam_score();
						System.out.println("totalScore: " + tTotalScore);
						Grade grade = GetScoreGrade(tTotalScore); // get the grade for the student's total score
						System.out.println("grade id: " + grade.getGrade_id());
						
						boolean passSubject = false;
						
						if(sub.getGrade_start() <= tTotalScore) // student passed the subject
						{
							passSubject = true;
						}
						
						if(!passSubject && sub.getCore() == 1) // if student failed subject and subject is core, then student failed for the term
						{
							pass = false;
						}
						
						// now we update the student score with the attendance and grade
						try
						{
							connectToDB();
							
							stored_procedure = con.prepareCall("{call up_student_subscores_byterm_sp(?,?,?,?,?,?,?)}");
							stored_procedure.setInt(1, sub.getSub_id());
							stored_procedure.setInt(2, st.getStudent_id());
							stored_procedure.setInt(3, term_id);
							stored_procedure.setDouble(4, attendance_score);
							stored_procedure.setInt(5, grade.getGrade_id());
							stored_procedure.setInt(6, user_id);
							stored_procedure.setInt(7, -1);
							stored_procedure.registerOutParameter(7, Types.INTEGER);
							
							stored_procedure.execute();
							
							if(stored_procedure.getInt(7) == 0)
							{
								con.commit();
							}
							else
							{
								con.rollback();
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
						
						score_found = true;
						break;
					}
				}
				
				if(!score_found)
				{
					// no score for student, so insert failed
					try
					{
						connectToDB();
						
						stored_procedure = con.prepareCall("{call crt_student_score_sp(?,?,?,?,?,?)}");
						stored_procedure.setInt(1, sub.getSub_id());
						stored_procedure.setInt(2, st.getStudent_id());
						stored_procedure.setString(3, "T");
						stored_procedure.setDouble(4, 0);
						stored_procedure.setInt(5, user_id);
						stored_procedure.setInt(6, -1);
						stored_procedure.registerOutParameter(6, Types.INTEGER);
						stored_procedure.execute();
						
						con.commit();
						
						stored_procedure = con.prepareCall("{call crt_student_score_sp(?,?,?,?,?,?)}");
						stored_procedure.setInt(1, sub.getSub_id());
						stored_procedure.setInt(2, st.getStudent_id());
						stored_procedure.setString(3, "E");
						stored_procedure.setDouble(4, 0);
						stored_procedure.setInt(5, user_id);
						stored_procedure.setInt(6, -1);
						stored_procedure.registerOutParameter(6, Types.INTEGER);
						stored_procedure.execute();
						
						con.commit();
						
						stored_procedure = con.prepareCall("{call up_student_subscores_byterm_sp(?,?,?,?,?,?,?)}");
						stored_procedure.setInt(1, sub.getSub_id());
						stored_procedure.setInt(2, st.getStudent_id());
						stored_procedure.setInt(3, term_id);
						stored_procedure.setDouble(4, 0); // attendance score
						stored_procedure.setInt(5, 0);
						stored_procedure.setInt(6, user_id);
						stored_procedure.setInt(7, -1);
						stored_procedure.registerOutParameter(7, Types.INTEGER);
						
						stored_procedure.execute();
						
						if(stored_procedure.getInt(7) == 0)
						{
							con.commit();
						}
						else
						{
							con.rollback();
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
				}
			}
			
			// insert the term result
			try
			{
				connectToDB();
				
				stored_procedure = con.prepareCall("{call crt_student_term_result_sp(?,?,?,?,?)}");
				stored_procedure.setInt(1, st.getStudent_id());
				stored_procedure.setInt(2, term_id);
				if(pass)
					stored_procedure.setString(3, "P");
				else
					stored_procedure.setString(3, "F");
				stored_procedure.setInt(4, user_id);
				stored_procedure.setInt(5, -1);
				stored_procedure.registerOutParameter(5, Types.INTEGER);
				
				stored_procedure.execute();
				
				if(stored_procedure.getInt(5) == 0)
				{
					con.commit();
				}
				else
				{
					con.rollback();
					ret += 1;
				}
			}
			catch(Exception ex)
			{
				ex.printStackTrace();
				ret += 1;
			}
			finally
			{
				closeConnection();
			}
			
			if(term.getTerm_nm().startsWith("3")) // third term, so we must generate the session result here as well
			{
				// session result is an average of all terms
				boolean studentPass = true;
				ArrayList<Term> terms = new SessionModel().GetSessionTerms(term.getSession_id());
				
				for(ClassSubject sub : subjects)
				{
					double termsTotalScore = 0;
					for(Term t : terms)
					{
						ArrayList<Score> allStudentsScores = GetClassStudentsAndScores(class_id, sub.getSub_id(), t.getTerm_id());
						for(Score score : allStudentsScores)
						{
							if(score.getStudent_id() == st.getStudent_id())
							{
								double attendance_score = 0;
								try
								{
									connectToDB();
									
									stored_procedure = con.prepareCall("{call get_student_subject_attendance_score_sp(?, ?, ?)}");
									stored_procedure.setInt(1, st.getStudent_id());
									stored_procedure.setInt(2, sub.getSub_id());
									stored_procedure.setInt(3, t.getTerm_id());
									
									result = stored_procedure.executeQuery();
									while(result.next())
									{
										attendance_score = result.getDouble(1);
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
								try
								{
									attendance_score = (attendance_score/grading.getAttendance())*100;
								}
								catch(Exception ig){}
								
								double tTotalScore = attendance_score + score.getTest_score() + score.getExam_score();
								termsTotalScore += tTotalScore;
								
								break;
							}
						}
					}
					
					termsTotalScore = termsTotalScore/3; // get the average for all 3 terms
					// Grade grade = GetScoreGrade(termsTotalScore); // get the grade for the student's total score
					
					boolean passSubject = false;
					if(sub.getGrade_start() <= termsTotalScore) // student passed the subject
					{
						passSubject = true;
					}
					
					if(!passSubject && sub.getCore() == 1) // if student failed subject and subject is core, then student failed for the term
					{
						studentPass = false;
					}
				}
				
				// now insert the session result
				try
				{
					connectToDB();
					
					stored_procedure = con.prepareCall("{call crt_student_session_result_sp(?,?,?,?,?)}");
					stored_procedure.setInt(1, st.getStudent_id());
					stored_procedure.setInt(2, term.getSession_id());
					if(studentPass)
						stored_procedure.setString(3, "P");
					else
						stored_procedure.setString(3, "F");
					stored_procedure.setInt(4, user_id);
					stored_procedure.setInt(5, -1);
					stored_procedure.registerOutParameter(5, Types.INTEGER);
					
					stored_procedure.execute();
					
					if(stored_procedure.getInt(5) == 0)
					{
						con.commit();
					}
					else
					{
						con.rollback();
						ret += 1;
					}
				}
				catch(Exception ex)
				{
					ex.printStackTrace();
					ret += 1;
				}
				finally
				{
					closeConnection();
				}
			}
		}
		
		return ret;
	}
	
	public ArrayList<Result> GetClassTermResult(int class_id, ArrayList<Term> terms)
	{
		ArrayList<Result> list = new ArrayList<Result>();
		
		Student searchBy = new Student();
		searchBy.setClass_id(class_id);
		ArrayList<Student> students = new StudentModel().getStudentsBySearch(searchBy);
		
		for(Student st : students)
		{
			Result e = new Result();
			e.setStudent(st);
			
			for(Term t : terms)
			{
				try
				{
					connectToDB();
					
					stored_procedure = con.prepareCall("{call get_student_term_result_sp(?,?)}");
					stored_procedure.setInt(1, st.getStudent_id());
					stored_procedure.setInt(2, t.getTerm_id());
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						TermResult tr = new TermResult();
						
						tr.setId(result.getInt(1));
						tr.setStudent_id(result.getInt(2));
						tr.setClass_id(class_id);
						tr.setTerm_id(result.getInt(3));
						tr.setResult(result.getString(4));
						tr.setPosition(result.getInt(5));
						tr.setUser_id(result.getInt(6));
						tr.setCrt_dt(result.getDate(7));
						tr.setTerm_nm(t.getTerm_nm());
						tr.setStudent_nm(st.getStudent_fn() + " " + st.getStudent_mn() + " " + st.getStudent_ln());
						tr.setSession_id(result.getInt(9));
						tr.setSession_nm(result.getString(10));
						
						e.getResults().add(tr);
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
			}
			
			list.add(e);
		}
		
		return list;
	}
	
	public ArrayList<Result> GetStudentTermResult(Student st, ArrayList<Term> terms)
	{
		ArrayList<Result> list = new ArrayList<Result>();
		
		Result e = new Result();
		e.setStudent(st);
		
		for(Term t : terms)
		{
			try
			{
				connectToDB();
				
				stored_procedure = con.prepareCall("{call get_student_term_result_sp(?,?)}");
				stored_procedure.setInt(1, st.getStudent_id());
				stored_procedure.setInt(2, t.getTerm_id());
				
				result = stored_procedure.executeQuery();
				while(result.next())
				{
					TermResult tr = new TermResult();
					
					tr.setId(result.getInt(1));
					tr.setStudent_id(result.getInt(2));
					tr.setClass_id(st.getCurClass_id());
					tr.setTerm_id(result.getInt(3));
					tr.setResult(result.getString(4));
					tr.setPosition(result.getInt(5));
					tr.setUser_id(result.getInt(6));
					tr.setCrt_dt(result.getDate(7));
					tr.setTerm_nm(t.getTerm_nm());
					tr.setStudent_nm(st.getStudent_fn() + " " + st.getStudent_mn() + " " + st.getStudent_ln());
					tr.setSession_id(result.getInt(9));
					tr.setSession_nm(result.getString(10));
					
					e.getResults().add(tr);
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
		}
		
		list.add(e);
		
		return list;
	}
	
	public boolean isTermResultAvailable(int class_id, int term_id)
	{
		boolean ret = false;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call is_term_result_available_sp(?,?)}");
			stored_procedure.setInt(1, class_id);
			stored_procedure.setInt(2, term_id);
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				if(result.getInt(1)>0)
				{
					ret = true;
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
}
