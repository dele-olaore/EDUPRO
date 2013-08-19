/*
 * Created on Mar 17, 2006
 *
 * A utility class that encrypts a string passed to its methods.
 * It loads the Encryption Key from a file passed to it.
 * @author Olaore Ismail Oladele.
 */
package com.dexter.bradawl.security;

import java.security.Security;
import java.security.Key;
import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;

import java.io.ByteArrayInputStream;
import java.io.ObjectInputStream;

import javax.crypto.Cipher;

import com.dexter.bradawl.util.Env;

import sun.misc.BASE64Encoder;

/**
 * @author Olaore Ismail Oladele
 *
 */
public class Encrypter
{
	public static String Encrypt(String text)
	{
		try
		{
			Security.addProvider(new com.sun.crypto.provider.SunJCE());
			Key key = null;
			
			Connection con = Env.getConnectionBradawl();
			
			CallableStatement getKey_sp = con.prepareCall("{call getKey_sp(?)}");
			getKey_sp.setInt(1, 0);
			
			ResultSet result = getKey_sp.executeQuery();
			int count = 0;
			while(result.next())
			{
				byte[] keyBytes = result.getBytes(1);
	            ByteArrayInputStream keyArrayStream =  new ByteArrayInputStream(keyBytes);
	            ObjectInputStream keyObjectStream =  new ObjectInputStream(keyArrayStream);
	            key = (Key)keyObjectStream.readObject();
				count++;
			}
			
			if(count == 0)
			{
				KeyGenerator.generateKey();
				result = getKey_sp.executeQuery();
				if(result.next())
				{
					byte[] keyBytes = result.getBytes(1);
		            ByteArrayInputStream keyArrayStream =  new ByteArrayInputStream(keyBytes);
		            ObjectInputStream keyObjectStream =  new ObjectInputStream(keyArrayStream);
		            key = (Key)keyObjectStream.readObject();
				}
			}
			
			Cipher cipher = Cipher.getInstance("DES/ECB/PKCS5Padding");
			cipher.init(Cipher.ENCRYPT_MODE, key);

			byte[] inputBytes = text.getBytes("UTF8");

			// Encode starts here

			byte[] outputBytes = cipher.doFinal(inputBytes);
			
			BASE64Encoder encoder = new BASE64Encoder();
			String base64 = encoder.encode(outputBytes);
			
			return base64;
			
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			return null;
		}
	}
}
