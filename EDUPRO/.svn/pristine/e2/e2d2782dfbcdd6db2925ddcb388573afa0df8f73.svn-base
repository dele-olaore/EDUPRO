/*
 * Created on Mar 17, 2006
 *
 * A utility class to generate keys used for password encryption and decryption.
 * @author Olaore Ismail Oladele
 */
package com.dexter.bradawl.security;

import java.security.Security;
import java.security.Key;
import java.security.SecureRandom;
import java.sql.CallableStatement;
import java.sql.Connection;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.ObjectOutputStream;

import com.dexter.bradawl.util.Env;

/**
 * A Key generator for java security implementation.
 * Used by 'Authentication' for its password encryption implementation.
 * 
 * @author Olaore Ismail Oladele
 */
public class KeyGenerator
{
	public static void generateKey()
	{
		try
		{
			// A security provider, since I'm just doing this, lets use SUN major provider.
			Security.addProvider(new com.sun.crypto.provider.SunJCE());
			
			javax.crypto.KeyGenerator generator = javax.crypto.KeyGenerator.getInstance("DES", "SunJCE");
			// Generate a new random key
			generator.init(56, new SecureRandom());
			Key key = generator.generateKey();
			
			try
			{
				ByteArrayOutputStream keyStore = new ByteArrayOutputStream();
				ObjectOutputStream keyObjectStream = new ObjectOutputStream(keyStore);
				keyObjectStream.writeObject(key);

				byte[] keyBytes = keyStore.toByteArray();
				ByteArrayInputStream keyArrayStream = new ByteArrayInputStream(keyBytes);
				
				Connection con = Env.getConnectionBradawl();
				CallableStatement crtkey_sp = con.prepareCall("{call crtkey_sp(?, ?)}");
				
				int output = -1;
				
				crtkey_sp.setBinaryStream(1, keyArrayStream, keyBytes.length);
				crtkey_sp.setInt(2, output);
				crtkey_sp.registerOutParameter(2, java.sql.Types.INTEGER);
				
				crtkey_sp.execute();
				output = crtkey_sp.getInt(2);
				
				con.commit();
			}
			catch(Exception io)
			{
				io.printStackTrace();
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
		}
	}
}
