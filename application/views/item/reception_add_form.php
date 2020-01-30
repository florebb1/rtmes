
<div class="details row">
	<div class="col-sm-12 form-group row">
		<label class="col-sm-2 col-form-label" >작업물  <button type="button" class="btn btn-danger details_remove">X</button></label>
	</div>
	<div class="col-sm-6 form-group row">
		<label class="col-sm-2 col-form-label" >치식선택(선택)</label>
		<div class="col-sm-10">
			<select class="form-control dental_formula" name="dental_formula[]">
				<option value="0">-선택-</option>
				<option value="R11">R11</option>
				<option value="R12">R12</option>
				<option value="R13">R13</option>
				<option value="R14">R14</option>
				<option value="R15">R15</option>
				<option value="R16">R16</option>
				<option value="R17">R17</option>
				<option value="R18">R18</option>
				<option value="R41">R41</option>
				<option value="R42">R42</option>
				<option value="R43">R43</option>
				<option value="R44">R44</option>
				<option value="R45">R45</option>
				<option value="R46">R46</option>
				<option value="R47">R47</option>
				<option value="R48">R48</option>
				<option value="L21">L21</option>
				<option value="L22">L22</option>
				<option value="L23">L23</option>
				<option value="L24">L24</option>
				<option value="L25">L25</option>
				<option value="L26">L26</option>
				<option value="L27">L27</option>
				<option value="L28">L28</option>
				<option value="L31">L31</option>
				<option value="L32">L32</option>
				<option value="L33">L33</option>
				<option value="L34">L34</option>
				<option value="L35">L35</option>
				<option value="L36">L36</option>
				<option value="L37">L37</option>
				<option value="L38">L38</option>
				
			</select>
		</div>
	</div>
	<div class="col-sm-6 form-group row">
		<label  class="col-sm-2 col-form-label">기공물 분류</label>
		<div class="col-sm-10">
			<select class="form-control item_category_id" name="item_category_id[]">
				<option value="0">-선택-</option>
				
				<?php for($i=0; $i<count($categorys); $i++){?>
                <option value="<?php echo $categorys[$i]["item_category_id"];?>"><?php echo $categorys[$i]["name_ko"];?></option>
                <?php }?>
			</select>
		</div>
	</div>
	<div class="col-sm-6 form-group row">
		<label class="col-sm-2 col-form-label">기공물 상세</label>
		<div class="col-sm-10">
			<select class="form-control item_id" name="item_id[]">
				<option value="0">-선택-</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 form-group row">
		<label class="col-sm-2 col-form-label ">교합</label>
		<div class="col-sm-10">
			<select class="form-control mixed"  name="mixed[]">
				<option value="0">-선택-</option>
				<option value="1">약(Light)</option>
				<option value="2">보통(Normal)</option>
				<option value="3">강(Full Contact)</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label " >인접면</label>
		<div class="col-sm-10">
			<select class="form-control surface" name="surface[]">
				<option value="0">-선택-</option>
				<option value="1">약(Open)</option>
				<option value="2">보통(Natural)</option>
				<option value="3">밀접(Close)</option>
			</select>
		</div>
	</div>
	<div class="col-sm-12 form-group row">
		<label class="col-sm-2 col-form-label">쉐이드</label>
		<div class="col-sm-10">
			<div class="checkbox">
    			<label>
    				<input type="checkbox" name="shade_insider[]" value="Insider" class="shade"> 인사이저
    			</label>
			</div>
			
			<div class="radio">
    			<label>
    				<input type="radio" name="Insider_color[]" value="A1" class="Insider_color"> A1
    				<input type="radio" name="Insider_color[]" value="A2" class="Insider_color"> A2
    				<input type="radio" name="Insider_color[]" value="A3" class="Insider_color"> A3
    				<input type="radio" name="Insider_color[]" value="A3.5" class="Insider_color"> A3.5
    				<input type="radio" name="Insider_color[]" value="A4" class="Insider_color"> A4
    				<input type="radio" name="Insider_color[]" value="B1" class="Insider_color"> B1
    				<input type="radio" name="Insider_color[]" value="B2" class="Insider_color"> B2
    				<input type="radio" name="Insider_color[]" value="B3" class="Insider_color"> B3
    				<input type="radio" name="Insider_color[]" value="B4" class="Insider_color"> B4
    				<input type="radio" name="Insider_color[]" value="C1" class="Insider_color"> C1
    				<input type="radio" name="Insider_color[]" value="C2" class="Insider_color"> C2
    				<input type="radio" name="Insider_color[]" value="C3" class="Insider_color"> C3
    				<input type="radio" name="Insider_color[]" value="C4" class="Insider_color"> C4
    				<input type="radio" name="Insider_color[]" value="D2" class="Insider_color"> D2
    				<input type="radio" name="Insider_color[]" value="D3" class="Insider_color"> D3
    				<input type="radio" name="Insider_color[]" value="D4" class="Insider_color"> D4
    			</label>
			</div>
		</div>
		<label class="col-sm-2 col-form-label"></label>
		<div class="col-sm-10">
			<div class="checkbox">
    			<label>
    				<input type="checkbox" name="shade_body[]" value="Body" class="shade"> 바디
    			</label>
			</div>
			
			<div class="radio">
    			<label>
    				<input type="radio" name="Body_color[]" value="A1" class="Body_color"> A1
    				<input type="radio" name="Body_color[]" value="A2" class="Body_color"> A2
    				<input type="radio" name="Body_color[]" value="A3" class="Body_color"> A3
    				<input type="radio" name="Body_color[]" value="A3.5" class="Body_color"> A3.5
    				<input type="radio" name="Body_color[]" value="A4" class="Body_color"> A4
    				<input type="radio" name="Body_color[]" value="B1" class="Body_color"> B1
    				<input type="radio" name="Body_color[]" value="B2" class="Body_color"> B2
    				<input type="radio" name="Body_color[]" value="B3" class="Body_color"> B3
    				<input type="radio" name="Body_color[]" value="B4" class="Body_color"> B4
    				<input type="radio" name="Body_color[]" value="C1" class="Body_color"> C1
    				<input type="radio" name="Body_color[]" value="C2" class="Body_color"> C2
    				<input type="radio" name="Body_color[]" value="C3" class="Body_color"> C3
    				<input type="radio" name="Body_color[]" value="C4" class="Body_color"> C4
    				<input type="radio" name="Body_color[]" value="D2" class="Body_color"> D2
    				<input type="radio" name="Body_color[]" value="D3" class="Body_color"> D3
    				<input type="radio" name="Body_color[]" value="D4" class="Body_color"> D4
    			</label>
			</div>
		</div>
		<label class="col-sm-2 col-form-label"></label>
		<div class="col-sm-10">
			<div class="checkbox">
    			<label>
    				<input type="checkbox" name="shade_cervical[]" value="Cervical" class="shade"> 써비컬
    			</label>
			</div>
			
			<div class="radio">
    			<label>
    				<input type="radio" name="Cervical_color[]" value="A1" class="Cervical_color"> A1
    				<input type="radio" name="Cervical_color[]" value="A2" class="Cervical_color"> A2
    				<input type="radio" name="Cervical_color[]" value="A3" class="Cervical_color"> A3
    				<input type="radio" name="Cervical_color[]" value="A3.5" class="Cervical_color"> A3.5
    				<input type="radio" name="Cervical_color[]" value="A4" class="Cervical_color"> A4
    				<input type="radio" name="Cervical_color[]" value="B1" class="Cervical_color"> B1
    				<input type="radio" name="Cervical_color[]" value="B2" class="Cervical_color"> B2
    				<input type="radio" name="Cervical_color[]" value="B3" class="Cervical_color"> B3
    				<input type="radio" name="Cervical_color[]" value="B4" class="Cervical_color"> B4
    				<input type="radio" name="Cervical_color[]" value="C1" class="Cervical_color"> C1
    				<input type="radio" name="Cervical_color[]" value="C2" class="Cervical_color"> C2
    				<input type="radio" name="Cervical_color[]" value="C3" class="Cervical_color"> C3
    				<input type="radio" name="Cervical_color[]" value="C4" class="Cervical_color"> C4
    				<input type="radio" name="Cervical_color[]" value="D2" class="Cervical_color"> D2
    				<input type="radio" name="Cervical_color[]" value="D3" class="Cervical_color"> D3
    				<input type="radio" name="Cervical_color[]" value="D4" class="Cervical_color"> D4
    			</label>
			</div>
		</div>
		
	</div>
	<div class="col-sm-6 form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label " >폰틱 디자인</label>
		<div class="col-sm-10">
			<select class="form-control pontic" name="pontic[]">
				<option value="0">-선택-</option>
				<option value="1">폰틱 디자인 1</option>
				<option value="2">폰틱 디자인 2</option>
				<option value="3">폰틱 디자인 3</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label " >메탈 디자인</label>
		<div class="col-sm-10">
			<select class="form-control metal" name="metal[]">
				<option value="0">-선택-</option>
				<option value="1">메탈 디자인 1</option>
				<option value="2">메탈 디자인 2</option>
				<option value="3">메탈 디자인 3</option>
			</select>
		</div>
	</div>

</div>