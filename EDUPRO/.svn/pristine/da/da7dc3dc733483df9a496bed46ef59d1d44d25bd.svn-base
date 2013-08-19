package com.dexter.bradawl.model;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.ArrayList;

import com.dexter.bradawl.dto.Message;
import com.dexter.bradawl.dto.To;
import com.dexter.bradawl.util.Env;

public class MessagesModel
{
	/*
	 * Private members for database access, retrieval and manipulation.
	 * */
	private Connection con;
	private CallableStatement stored_procedure;
	private ResultSet result;
	
	// private int output = -1;
	// private String empty = "";
	
	public MessagesModel()
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
	 * Send a message
	 * */
	public int SendMessage(Message m)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call crt_message_sp(?,?,?,?,?)}");
			stored_procedure.setString(1, m.getSubject());
			stored_procedure.setString(2, m.getBody());
			stored_procedure.setInt(3, m.getSender_id());
			stored_procedure.setInt(4, -1);
			stored_procedure.setInt(5, -1);
			stored_procedure.registerOutParameter(4, Types.INTEGER);
			stored_procedure.registerOutParameter(5, Types.INTEGER);
			
			stored_procedure.execute();
			ret = stored_procedure.getInt(5);
			if(ret == 0)
			{
				int m_id = stored_procedure.getInt(4);
				
				for(To t : m.getTo())
				{
					stored_procedure = con.prepareCall("{call crt_message_sent_sp(?,?,?)}");
					stored_procedure.setInt(1, m_id);
					stored_procedure.setString(2, t.getUsername());
					stored_procedure.setInt(3, -1);
					stored_procedure.registerOutParameter(3, Types.INTEGER);
					
					stored_procedure.execute();
				}
				
				con.commit();
			}
			else
				con.rollback();
		}
		catch(Exception ex)
		{
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
	
	public ArrayList<Message> MyMessages(int type, int user_id)
	{
		ArrayList<Message> list = new ArrayList<Message>();
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call get_mymessages_sp(?,?)}");
			stored_procedure.setInt(1, user_id);
			stored_procedure.setInt(2, type);
			
			result = stored_procedure.executeQuery();
			while(result.next())
			{
				// m.message_id, m.message_subject, m.message_body, m.user_id as sender_id, u.username, m.sent_dt, ms.message_sent_id, ms.user_id, ms.status
				Message m = new Message();
				
				m.setId(result.getInt(1));
				m.setSubject(result.getString(2));
				m.setBody(result.getString(3));
				m.setSender_id(result.getInt(4));
				m.setUsername(result.getString(5));
				m.setSent_dt(result.getDate(6));
				m.setSent_id(result.getInt(7));
				m.setStatus(result.getInt(9));
				
				list.add(m);
			}
			
			if(type == 2) // sent messages
			{
				// get the 'To' list
				stored_procedure = con.prepareCall("{call get_message_tolist_sp(?)}");
				for(Message m : list)
				{
					stored_procedure.setInt(1, m.getId());
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						To e = new To();

						e.setUser_id(result.getInt(1));
						e.setUsername(result.getString(2));
						e.setName(result.getString(3));
						
						m.getTo().add(e);
					}
					
					m.setSender_nm("Me");
				}
			}
			else if(type == 1) // inbox
			{
				// get senders name
				stored_procedure = con.prepareCall("{call get_message_sendername_sp(?)}");
				for(Message m : list)
				{
					stored_procedure.setInt(1, m.getId());
					
					result = stored_procedure.executeQuery();
					while(result.next())
					{
						m.setSender_nm(result.getString(3));
					}
				}
			}
		}
		catch(Exception ex)
		{}
		finally
		{
			closeConnection();
		}
		
		return list;
	}
	
	/**
	 * Update message status.
	 * */
	public int UpdateMessageStatus(Message m)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call up_message_sent_sp(?,?,?)}");
			stored_procedure.setInt(1, m.getSent_id());
			stored_procedure.setInt(2, m.getStatus());
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
	 * Deletes a message, either from inbox or sent.
	 * */
	public int DeleteMessage(Message m)
	{
		int ret = -1;
		
		try
		{
			connectToDB();
			
			stored_procedure = con.prepareCall("{call del_message_sp(?,?)}");
			stored_procedure.setInt(1, m.getSent_id());
			stored_procedure.setInt(2, -1);
			stored_procedure.registerOutParameter(2, Types.INTEGER);
			
			stored_procedure.execute();
			
			ret = stored_procedure.getInt(2);
			if(ret == 0)
				con.commit();
			else
				con.rollback();
		}
		catch(Exception ex)
		{
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
}
