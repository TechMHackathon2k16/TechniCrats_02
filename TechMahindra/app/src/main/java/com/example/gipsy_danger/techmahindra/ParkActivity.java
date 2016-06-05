package com.example.gipsy_danger.techmahindra;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
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

public class ParkActivity extends AppCompatActivity {
    AutoCompleteTextView autoCompleteTextView;
    String urlParameters;
   ProgressBar pr;
    String urlAlert="http://parkalert.xyz/loginportal/android/alertmessage.php";
    String urlSearch="http://parkalert.xyz/loginportal/android/search.php";
int x=1;
    ArrayList<String> arrayList;
    HttpURLConnection connection;
    URL url;
    String myData;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_park);

        pr= (ProgressBar) findViewById(R.id.parkProgressBar);
        pr.setVisibility(View.INVISIBLE);

         autoCompleteTextView= (AutoCompleteTextView) findViewById(R.id.autoCompleteTextView);
        Button btn= (Button) findViewById(R.id.parkSearch);

        assert btn != null;
        btn.setOnClickListener(new View.OnClickListener() {
                   @Override
                   public void onClick(View v) {
                       if(!autoCompleteTextView.getText().toString().isEmpty()){
                           x=0;

                           String real=autoCompleteTextView.getText().toString();
                           String xy=real.replaceAll("\\s+","");

                           String arr[]=xy.split("-");

                           urlParameters ="search="+arr[1];
                           new ABC().execute();

                       }else {
                           Toast.makeText(ParkActivity.this,"Enter car number",Toast.LENGTH_LONG).show();
                       }
                   }
               });

        arrayList=new ArrayList<String>();

        autoCompleteTextView.addTextChangedListener(new TextWatcher() {

            String afterTextChanged = "";
            String beforeTextChanged = "";
            String onTextChanged = "";

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                onTextChanged = autoCompleteTextView.getText().toString();
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                beforeTextChanged = autoCompleteTextView.getText().toString();

                if (beforeTextChanged.length() >= 1) {
                     String district = beforeTextChanged;
                    urlParameters ="search=" + district;
                    //    Toast.makeText(HospitalActivity.this, urlParameters, Toast.LENGTH_LONG).show();
//                    ConnectionDetector cd = new ConnectionDetector(getApplicationContext());

//                    Boolean isInternetPresent = cd.isConnectingToInternet();

//                    if (isInternetPresent ) {

                        new ABC().execute();
//                    }else{
//                        showAlertDialog(HospitalActivity.this, "No Internet Connection",
//                                "You don't have internet connection.", false);
//                    }
                    // arrayList.clear();
                }
            }

            @Override
            public void afterTextChanged(Editable s) {
                //   Toast.makeText(HospitalActivity.this, "before: " + beforeTextChanged
                //         + '\n' + "on:  urlParameters="k1="+stateName+"&k2="+district;" + onTextChanged
                //       + '\n' + "after: " + afterTextChanged
                //     ,Toast.LENGTH_SHORT).show();

            }
        });


    }


    public class ABC extends AsyncTask<String,String,String> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            if(x==0) {

                pr.setVisibility(View.VISIBLE);
            }
            // Toast.makeText(HospitalActivity.this,"I M In Async task",Toast.LENGTH_LONG).show();



        }

        @Override
        protected String doInBackground(String... params) {
            try {


                // instantiate the URL object with the target URL of the resource to
                // request
                if(x==0) {
                    url = new URL(urlAlert);
                }else{
                    url = new URL(urlSearch);
                }


                // instantiate the HttpURLConnection with the URL object - A new
                // connection is opened every time by calling the openConnection
                // method of the protocol handler for this URL.
                // 1. This is the point where the connection is opened.
                connection= (HttpURLConnection) url.openConnection();


                // set connection output to true
                connection.setDoOutput(true);


                connection.setDoInput(true);
                // instead of a GET, we're going to send using method="POST"
                //..................................................................................
                connection.setRequestMethod("POST");

                OutputStreamWriter writer = new OutputStreamWriter(
                        connection.getOutputStream());

                // write data to the connection. This is data that you are sending
                // to the server
                // 3. No. Sending the data is conducted here. We established the
                // connection with getOutputStream
                writer.write(urlParameters);

                Log.e("urlparameters",urlParameters);

                writer.close();
                //.....................................................................................
                // if there is a response code AND that response code is 200 OK, do
                // stuff in the first if block
                if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                    // OK
                    Log.e("piyush", "Everythingh is allright bjkkj");
                    // otherwise, if any other status code is returned, or no status
                    // code is returned, do stuff in the else block
                } else {
                    Log.e("piyush","something error ");
                    // Server returned HTTP error code.
                }
                InputStream is=connection.getInputStream();
                BufferedReader bufferedReader=new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
                StringBuffer strbuilder=new StringBuffer();
                String line=null;
                while((line=bufferedReader.readLine())!=null){
                    strbuilder.append(line);
                }
                myData=strbuilder.toString();
                Log.e("myData=",myData);


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            //....................................................................................
            // JSON PARSING>> :)


            if (myData != null && x==1) {
                try {
                    //  JSONObject jsonObj = new JSONObject(myData);

                    // Getting JSON Array node
                    JSONArray hospital = new JSONArray(myData);

                    arrayList.clear();

                    // looping through All Contacts
                    for (int i = 0; i < hospital.length(); i++) {
                        JSONObject c = hospital.getJSONObject(i);

                        String str=c.getString("display")+"   -   "+c.getString("car");
                        arrayList.add(str);
                        Log.e("city_name",str);


                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }catch (ArrayIndexOutOfBoundsException e){

                }
            } else {
                Log.e("ServiceHandler", "Couldn't get any data from the url");
            }






            //.........................................................................................

            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            //.................


//..............................................................................................
            // AUTOCOMPLETE TEXT VIEW
            // String[] countries = getResources().getStringArray(R.array.state);
if(x==1) {

    ArrayAdapter<String> tAadapter = new ArrayAdapter<String>(ParkActivity.this, android.R.layout.simple_list_item_1, arrayList);

    // tAadapter.notifyDataSetChanged();
    autoCompleteTextView.setAdapter(tAadapter);


    Log.e("piyush", "adapter is set");
}else {
    pr.setVisibility(View.INVISIBLE);
    Toast.makeText(ParkActivity.this,"your message has been sent",Toast.LENGTH_LONG).show();
    Intent in=new Intent(ParkActivity.this,HomeActivity.class);
    startActivity(in);
}

//..............................................................................................


        }
    }

}
