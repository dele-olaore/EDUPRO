package com.dexter.bradawl.util;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.In;
import org.jboss.seam.annotations.Name;
import org.jboss.seam.annotations.Scope;

import com.dexter.bradawl.mbean.AuthenticatorBean;
import com.dexter.bradawl.model.OptionModel;

@Name("userOptions")
@Scope(ScopeType.SESSION)
public class UserOptions implements java.io.Serializable
{
	private static final long serialVersionUID = 1L;
	
	@In(create=true)
	AppOptions appOptions;
	
	private String skin;
	
	@In(create=true)
	AuthenticatorBean authenticator;
	
	public String getSkin()
	{
		if(skin == null)
		{
			skin = appOptions.getDefaultSkin();
		}
		
		return skin;
	}
	
	public void setSkin(String skin)
	{
		this.skin = skin;
	}
	
	public void setOptions()
	{
		new OptionModel().setUserOptions(new String[]{skin}, authenticator.getUser().getUser_id());
	}
}
