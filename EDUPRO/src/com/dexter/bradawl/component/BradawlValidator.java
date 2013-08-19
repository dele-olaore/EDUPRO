package com.dexter.bradawl.component;

import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
// import javax.faces.validator.BeanValidator;
// import javax.validation.ValidationException;

import org.jboss.seam.ui.validator.ModelValidator;

import org.jboss.seam.ScopeType;
import org.jboss.seam.annotations.*;

@Name("bradawlValidator")
@Scope(ScopeType.APPLICATION)
public class BradawlValidator extends ModelValidator implements java.io.Serializable // BeanValidator
{
	private static final long serialVersionUID = 1L;
	
	@Override
    public void validate(FacesContext context, UIComponent component, Object value)
	{
		System.out.println("Got here");
        if (doValidation(context))
        {
            super.validate(context, component, value);
        }
        // simply skip it...
    }

    private boolean doValidation(FacesContext context)
    {
        // main page (action that saves the main entity) 
        if (context.getExternalContext().getRequestParameterValuesMap().containsKey("form:save"))
        {
            return true;
        }

        // sub page (action that binds the entered data to an associated entity)
        if (context.getExternalContext().getRequestParameterValuesMap().containsKey("form:ok"))
        {
            return true;
        }

        return false;
    }
}
