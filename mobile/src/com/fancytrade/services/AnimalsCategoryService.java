package com.fancytrade.services;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.ReclamationCategory;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class AnimalsCategoryService {

    public static AnimalsCategoryService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<ReclamationCategory> listAnimalsCategory;

    

    private AnimalsCategoryService() {
        cr = new ConnectionRequest();
    }

    public static AnimalsCategoryService getInstance() {
        if (instance == null) {
            instance = new AnimalsCategoryService();
        }
        return instance;
    }
    
    public ArrayList<ReclamationCategory> getAll() {
        listAnimalsCategory = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URLf + "category/Allcat");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listAnimalsCategory = getList();
                }

                cr.removeResponseListener(this);
            }
        });

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return listAnimalsCategory;
    }

    private ArrayList<ReclamationCategory> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                ReclamationCategory AnimalsCategory = new ReclamationCategory(
                        (int) Float.parseFloat(obj.get("id").toString()),
                        
                        (String) obj.get("nom")
                   
                        
                        
                );

                listAnimalsCategory.add(AnimalsCategory);
            }
        } catch (IOException  e) {
            e.printStackTrace();
        }
        return listAnimalsCategory;
    }
    
    public int add(ReclamationCategory AnimalsCategory) {
        return manage(AnimalsCategory, false);
    }

    public int edit(ReclamationCategory AnimalsCategory) {
        return manage(AnimalsCategory, true );
    }

    public int manage(ReclamationCategory AnimalsCategory, boolean isEdit) {
        
        cr = new ConnectionRequest();

        
        cr.setHttpMethod("POST");
        if (isEdit) {
            cr.setUrl(Statics.BASE_URLf + "category/updateJSON/"+AnimalsCategory.getId()+"?nom="+AnimalsCategory.getNom());
        } else {
        
        cr.setUrl(Statics.BASE_URLf + "category/catJson?nom="+AnimalsCategory.getNom());
       // cr.addArgument("id", String.valueOf(ReclamationCategory.getId()));
        }
        
        
        cr.addArgument("nom", AnimalsCategory.getNom());
        //cr.addArgument("Race", ReclamationCategory.getRace());
        
        
        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultCode = cr.getResponseCode();
                cr.removeResponseListener(this);
            }
        });
        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception ignored) {

        }
        return resultCode;
    }

    public int delete(int AnimalsCategoryId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URLf +"category/"+AnimalsCategoryId+"/del");
        cr.setHttpMethod("POST");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cr.removeResponseListener(this);
            }
        });

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return cr.getResponseCode();
    }
}
