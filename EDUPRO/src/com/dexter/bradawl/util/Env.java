package com.dexter.bradawl.util;

import java.sql.Connection;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.sql.DataSource;

public class Env
{
	/**
	 * Static variable for getting context configurations.
	 * Used by all methods to retrieve the environment context.
	 * */
	private static Context initCtx;
	private static Context envCtx;
	
	/*
	 * Static block for context environment connection.
	 * */
	static
	{
		try
		{
			initCtx = new InitialContext();
			envCtx = (Context)initCtx.lookup("java:comp/env");
		}
		catch(Exception ex)
		{
			System.out.println("Error initailizing the context environment...");
			ex.printStackTrace();
		}
	}
	
	/**
	 * Gets connection to the 'BradawlNew' database on server 'Local'.
	 * Uses a dsn-less mode of connection. [requires no odbc datasource]
	 * @return java.sql.Connection
	 * */
	public static Connection getConnectionBradawl()
	{
		try
		{
			DataSource ds = (DataSource)envCtx.lookup("jdbc/bradawlDB");
			Connection con = ds.getConnection();
			con.setAutoCommit(false);
			con.setTransactionIsolation(Connection.TRANSACTION_READ_UNCOMMITTED);
			return con;
		}
		catch(Exception ex)
		{
			System.out.println("Error retrieving the data source from the context...");
			ex.printStackTrace();
			return reconnectBradawl();
		}
	}
	
	/**
	 * Reconnects the con connection object to the database BradawlNew.
	 * */
	public static Connection reconnectBradawl()
	{
		try
		{
			DataSource ds = (DataSource)envCtx.lookup("jdbc/bradawlDB");
			Connection con = ds.getConnection();
			con.setAutoCommit(false);
			con.setTransactionIsolation(Connection.TRANSACTION_READ_UNCOMMITTED);
			return con;
		}
		catch(Exception ex)
		{
			System.out.println("Error retrieving the data source from the context...");
			ex.printStackTrace();
			return null;
		}
	}
	
	/**
	 * Gets connection to the 'EduProSocial' database on server 'Local'.
	 * Uses a dsn-less mode of connection. [requires no odbc datasource]
	 * @return java.sql.Connection
	 * */
	public static Connection getConnectionEduPro()
	{
		try
		{
			DataSource ds = (DataSource)envCtx.lookup("jdbc/eduproDB");
			Connection con = ds.getConnection();
			con.setAutoCommit(false);
			con.setTransactionIsolation(Connection.TRANSACTION_READ_UNCOMMITTED);
			return con;
		}
		catch(Exception ex)
		{
			System.out.println("Error retrieving the data source from the context...");
			ex.printStackTrace();
			return reconnectEduPro();
		}
	}
	
	/**
	 * Reconnects the con connection object to the database BradawlNew.
	 * */
	public static Connection reconnectEduPro()
	{
		try
		{
			DataSource ds = (DataSource)envCtx.lookup("jdbc/eduproDB");
			Connection con = ds.getConnection();
			con.setAutoCommit(false);
			con.setTransactionIsolation(Connection.TRANSACTION_READ_UNCOMMITTED);
			return con;
		}
		catch(Exception ex)
		{
			System.out.println("Error retrieving the data source from the context...");
			ex.printStackTrace();
			return null;
		}
	}
}