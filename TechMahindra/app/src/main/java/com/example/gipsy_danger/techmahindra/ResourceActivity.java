package com.example.gipsy_danger.techmahindra;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.GridView;
import android.widget.ListView;

public class ResourceActivity extends AppCompatActivity {

    String data[]={"Plumber","Electrician"};
    int images[]={R.drawable.plumber,R.drawable.electrician};
//    ,"Household Services","carpenters","cook","waste collectors
//    ,R.drawable.hous,R.drawable.hous,R.drawable.cook,R.drawable.naukar

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_resource);

        GridView lv= (GridView) findViewById(R.id.resourceListView);

        lv.setAdapter(new GridAdapter(ResourceActivity.this,data,images));


        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                switch (position){
                    case 0:  Intent in =new Intent(ResourceActivity.this,PlumberActivity.class);
                              in.putExtra("intentData","plumber");
                              startActivity(in);
                        break;
                    case 1:Intent in1 =new Intent(ResourceActivity.this,PlumberActivity.class);

                        in1.putExtra("intentData","electrician");
                        startActivity(in1);  ; break;
                }
            }
        });
    }
}
