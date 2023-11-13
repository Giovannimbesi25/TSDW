import java.io.*;
import java.net.*;
import java.util.*;

public class DatagramUtility {	
    // metodo per creare un pacchetto da una stringa
    static protected DatagramPacket buildPacket(InetAddress addr, int port, String msg) throws IOException{
        ByteArrayOutputStream boStream = new ByteArrayOutputStream();
        DataOutputStream doStream = new DataOutputStream(boStream);
        //scrive nel flusso di output il messaggio in UTF-8
        doStream.writeUTF(msg);
        //Estrae l'array di byte dai dati scritti nel flusso doStream
        byte[] data = boStream.toByteArray();
        return new DatagramPacket(data, data.length, addr, port);
        
        // viene eseguita per convertire la stringa msg in un array di byte in modo che la stringa possa essere inviata come dati in un pacchetto Datagram.
    }
	
    // metodo per recuperare una stringa da un pacchetto 
    static protected String getContent(DatagramPacket dp) throws IOException{
        ByteArrayInputStream biStream = new ByteArrayInputStream(dp.getData(), 0, dp.getLength());
        DataInputStream diStream = new DataInputStream(biStream);
        String msg = diStream.readUTF();
        return msg;
    }	
}