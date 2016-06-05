package com.example.gipsy_danger.techmahindra;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;

public class PlumberActivity extends AppCompatActivity {

    ProgressBar pr;

    ArrayList<String>  arrayList;
    String urlString;
    ArrayList<String> phn=new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_plumber);

        pr= (ProgressBar) findViewById(R.id.plumberProgressBar);
        pr.setVisibility(View.INVISIBLE);
        arrayList=new ArrayList<>();
         String str=null;
        str=getIntent().getExtras().getString("intentData");
//        Log.e("plumber",str);
        assert str != null;
        if(str.equals("plumber")){
            urlString=" http://parkalert.xyz/loginportal/android/plumber.php";
        }else{
            urlString="http://parkalert.xyz/loginportal/android/electrician.php";
        }

        new Plumber().execute();










//        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
//        fab.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
//                        .setAction("Action", null).show();
//            }
//        });
    }
    private class Plumber extends AsyncTask<String,String,String> {

        String myData="123";
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            Log.e("kjsdnf","jhbdc");
            pr.setVisibility(View.VISIBLE);

        }

        @Override
        protected String doInBackground(String... params) {

            try {
                URL url=new URL(urlString);



                HttpURLConnection connection= (HttpURLConnection) url.openConnection();


                // set connection output to true
                connection.setDoOutput(true);
                connection.setDoInput(true);



                connection.setRequestMethod("POST");
                //    connection.addRequestProperty("Cache-Control", "only-if-cached");
                OutputStreamWriter writer = new OutputStreamWriter(
                        connection.getOutputStream());


                writer.write("");

                writer.close();




                InputStream is=connection.getInputStream();
                BufferedReader bufferedReader=new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
                StringBuffer strbuilder=new StringBuffer();
                String line=null;
                while((line=bufferedReader.readLine())!=null){///errror hre
                    strbuilder.append(line);
                }
                myData=strbuilder.toString();
                Log.e("plumber Signi n", myData);


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            if (myData != null) {
                try {
                    //  JSONObject jsonObj = new JSONObject(myData);

                    // Getting JSON Array node
                    Log.e("plumber kjnkjnSigni n", myData);


                    String arr=myData.replaceAll("<","");
                    Log.e("plumber Signi njhbhjkbl", arr);

                    JSONArray hospital = new JSONArray(arr);


                    // looping through All Contacts
                    for (int i = 0; i < hospital.length(); i++) {
                        JSONObject c = hospital.getJSONObject(i);

                        String str=c.getString("Name")+"\nMobile:-"+c.getString("Mobile_Number")+"\nOccupation:-"+c.getString("Occupation")+"\nLocation:-"+c.getString("Location");
                        arrayList.add(str);
                        phn.add(c.getString("Mobile_Number"));
                        Log.e("city_name",str);


                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }catch (ArrayIndexOutOfBoundsException e){

                }
            } else {
                Log.e("ServiceHandler", "Couldn't get any data from the url");
            }
            return myData;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            pr.setVisibility(View.INVISIBLE);
            if((s!=null)) {

                ListView lv= (ListView) findViewById(R.id.plumberListView);
             ResourceDetails   md=new ResourceDetails(PlumberActivity.this,arrayList,phn);
                lv.setAdapter(md);

            }else{
                Toast.makeText(PlumberActivity.this,"Check your internet connection",Toast.LENGTH_LONG).show();
            }


        }
    }

}
