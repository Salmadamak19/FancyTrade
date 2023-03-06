/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Services;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import org.json.JSONObject;

/**
 *
 * @author oussema
 */
public class ServiceChat {

    public String getLocation() {
        String url = "http://ip-api.com/json/?fields=lat,lon";
        int lat = 0, lon = 0;
        try {
            URL obj = new URL(url);
            HttpURLConnection con = (HttpURLConnection) obj.openConnection();

            BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String inputLine;
            StringBuffer response = new StringBuffer();

            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
            in.close();

            JSONObject json = new JSONObject(response.toString());
            lat = json.getInt("lat");
            lon = json.getInt("lon");
            System.out.println("Latitude: " + lat);
            System.out.println("Longitude: " + lon);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return Integer. toString(lat)+"--"+Integer. toString(lon);
    }
    

}
