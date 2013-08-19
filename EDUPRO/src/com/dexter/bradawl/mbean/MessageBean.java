package com.dexter.bradawl.mbean;

import java.util.ArrayList;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Logger;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;
import org.jboss.seam.log.Log;

import com.dexter.bradawl.dto.Message;
import com.dexter.bradawl.dto.To;
import com.dexter.bradawl.model.MessagesModel;
import com.dexter.bradawl.util.AppOptions;
import com.dexter.bradawl.util.Utils;
import com.sun.faces.context.FacesContextImpl;

@Name("messagesBean")
@Scope(ScopeType.SESSION)
public class MessageBean implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@Logger
	private Log log;
	
	@In
	private AppOptions appOptions;
	
	private Message messageToSend;
	private Message viewingMessage;
	
	private String to;
	
	public void AddRecipient(String type, int id, String fn, String mn, String ln)
	{
		String t = type+id;
		String name = fn + " " + mn + " " + ln;
		
		if(getMessageToSend() != null) //  && getTo() != null
		{
			boolean exists = false;
			To to = new To();
			to.setUsername(t);
			to.setName(name);
			// String[] toArr = new String[]{to, name};
			
			for(To e : getMessageToSend().getTo())
			{
				if(e.getUsername().equalsIgnoreCase(to.getUsername()))
				{
					exists = true;
					break;
				}
			}
			
			if(!exists)
				getMessageToSend().getTo().add(to);
		}
	}
	
	public void RemoveRecipient(String to)
	{
		for(To e : getMessageToSend().getTo())
		{
			if(e.getUsername().equalsIgnoreCase(to))
			{
				getMessageToSend().getTo().remove(e);
				break;
			}
		}
		
		getMessageToSend().getTo().trimToSize();
	}
	
	public void SendMessage()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		if(getMessageToSend() != null && getMessageToSend().getTo().size() > 0)
		{
			int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
			getMessageToSend().setSender_id(user_id);
			
			int ret = new MessagesModel().SendMessage(getMessageToSend());
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("message.sent", null), null));
					setMessageToSend(null);
					
					break;
				}
				case -2:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("entry.duplicate", null), null));
					
					break;
				}
				default:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("message.failed", null), null));
					break;
				}
			}
		}
	}

	public ArrayList<Message> getInbox()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
		return new MessagesModel().MyMessages(1, user_id);
	}
	
	public int getUnread()
	{
		int c = 0;
		ArrayList<Message> marr = getInbox();
		
		for(Message e : marr)
		{
			if(e.getStatus() == 1)
				c += 1;
		}
		
		return c;
	}
	
	public ArrayList<Message> getSent()
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		int user_id = ((AuthenticatorBean)curContext.getExternalContext().getSessionMap().get("authenticator")).getUser().getUser_id();
		return new MessagesModel().MyMessages(2, user_id);
	}
	
	public void DeleteMessage(Message m)
	{
		FacesContext curContext = FacesContextImpl.getCurrentInstance();
		
		if(m != null)
		{
			int ret = new MessagesModel().DeleteMessage(m);
			switch(ret)
			{
				case 0:
				{
					curContext.addMessage(null, new FacesMessage(FacesMessage.SEVERITY_INFO, Utils.getBundleMessage("message.del.success", null), null));
					break;
				}
			}
		}
	}
	
	public Message getMessageToSend()
	{
		if(messageToSend == null)
			messageToSend = new Message();
		return messageToSend;
	}

	public void setMessageToSend(Message messageToSend)
	{
		this.messageToSend = messageToSend;
	}

	public Message getViewingMessage()
	{
		if(viewingMessage == null)
			viewingMessage = new Message();
		return viewingMessage;
	}

	public String setViewingMessage(Message viewingMessage, int type)
	{
		this.viewingMessage = viewingMessage;
		
		if(type == 1) // inbox
		{
			// update message status to read
			getViewingMessage().setStatus(0); // mark as read
			new MessagesModel().UpdateMessageStatus(getViewingMessage());
		}
		
		return "message";
	}

	public String getTo()
	{
		return to;
	}

	public void setTo(String to)
	{
		this.to = to;
	}
	
}
