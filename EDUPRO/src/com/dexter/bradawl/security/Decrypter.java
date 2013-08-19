/*
 * Created on Mar 17, 2006
 *
 * A utility class that decrypts a string passed to its methods.
 * It loads the Decryption Key from a file passed to it.
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
// import java.io.FileInputStream;

import javax.crypto.Cipher;

import com.dexter.bradawl.util.Env;

import sun.misc.BASE64Encoder;

/**
 * @author Olaore Ismail Oladele
 * Modified to get key from db instead of file on 6 July, 2012
 */
public class Decrypter
{
	public static String Decrypt(String text)
	{
		try
		{
			Security.addProvider(new com.sun.crypto.provider.SunJCE());
			Key key = null;
			
			/*ObjectInputStream in = new ObjectInputStream (new FileInputStream(keyFile));
			key = (Key)in.readObject();
			in.close();*/
			
			Connection con = Env.getConnectionBradawl();
			
			CallableStatement getKey_sp = con.prepareCall("{call getKey_sp(?)}");
			getKey_sp.setInt(1, 0);
			
			ResultSet result = getKey_sp.executeQuery();
			while(result.next())
			{
				byte[] keyBytes = result.getBytes(1);
	            ByteArrayInputStream keyArrayStream =  new ByteArrayInputStream(keyBytes);
	            ObjectInputStream keyObjectStream =  new ObjectInputStream(keyArrayStream);
	            key = (Key)keyObjectStream.readObject();
			}
			
			if(key != null)
			{
				Cipher cipher = Cipher.getInstance("DES/ECB/PKCS5Padding");
				cipher.init(Cipher.DECRYPT_MODE, key);
				
				byte[] inputBytes = text.getBytes("UTF8");
				//byte[] inputBytes = text.getBytes();
				
				// Decode starts here
				
				byte[] outputBytes = cipher.doFinal(inputBytes);
				
				BASE64Encoder encoder = new BASE64Encoder();
				String base64 = encoder.encode(outputBytes);
				
				return base64;
			}
			else
			{
				return null;
			}
		}
		catch(Exception ex)
		{
			ex.printStackTrace();
			return null;
		}
	}
}
