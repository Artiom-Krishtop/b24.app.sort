$().ready(function(){

    let html = $('html');
    
    BX24.resizeWindow(html.width(), html.height());
});

let editObj = {

    companyTypeList:{},
    companyList:{},
    valueContainer:{},
    removeValueBtn:{},
    selectDropList:{},
    selectDropBtn:{},
    options:{},
    btnSelect:{},

    init: function(options = {}){
        this.companyTypeList = $('.company-type-list__item-wrapper');
        this.companyList = $('.company-list__item-wrapper');
        this.valueContainer = $('#value-container');
        this.selectDropList = $('#select-drop-list');
        this.selectDropBtn = $('#btn-drop');
        this.btnSelect = $('#btn-select');
        this.options = options;

        this.setEventHandler();
    },

    setEventHandler: function(){
        that = this;

        this.companyList.click(function(){
            if(!$(this).hasClass('select')){
                that.selectCompany(this);
            }
        });

        this.companyTypeList.click(function(){
            if(!$(this).hasClass('select')){
                that.selectCompanyType(this);
            }
        });

        this.btnSelect.click(function(){
            that.viewSelectBlock();
        });

        this.valueContainer.find('.close').click(function(){
            valItem = $(this).parent('.company-field__value');
            that.removeValue(valItem);
        });
    },

    viewSelectBlock: function() {
        if(this.selectDropList.hasClass('hide')){
            this.selectDropList.removeClass('hide');
        }else{
            this.selectDropList.addClass('hide');
        }

        html = $('html');
        BX24.resizeWindow(html.width(), html.height());
    },

    selectCompanyType: function(el){
        selectCompanyType = $(el).data('company-type-id');

        this.companyTypeList.removeClass('select'); 
        $(el).addClass('select');

        if(selectCompanyType == 'all'){
            this.companyList.show();

            return;
        }
     
        for (let i = 0; i < this.companyList.length; i++) {
            company = $(this.companyList[i]);

            if(company.data('company-type') !== selectCompanyType){
                company.hide();
            }else{
                company.show();
            }
        }
    },

    selectCompany: function(el){
        valueBlock = '<div class="company-field__value"><span class="company-name"></span><span class="close"></span></div>';
        companyName = $(el).children('.company-list__item').html();
        companyId = String($(el).data('company-id'));

        valueBlock = $(valueBlock);
        valueBlock.data('id', companyId);
        valueBlock.children('.company-name').html(companyName);

        valueBlock.children('.close').click(function(){
            valItem = $(this).parent('.company-field__value');
            that.removeValue(valItem);
        });

        if(typeof this.options.multiple !== 'undefined' && this.options.multiple == 'Y'){
            this.setMultipleValue(companyId);
        }else{
            this.setValue(companyId);

            itemValue = this.valueContainer.find('.company-field__value');

            if(itemValue.length > 0){
                this.removeValue(itemValue);
            }
        }

        this.valueContainer.prepend(valueBlock);

        $(el).addClass('select');
    },

    removeValue: function(el){
        companyId = String(el.data('id'));
        valueItem = this.selectDropList.find('.company-list__item-wrapper[data-company-id="' + companyId + '"]');
        promisVal = this.getValue();

        that = this;

        promisVal.then(function(val){
            if(val.indexOf(companyId) !== -1){
                val = val.filter(function(f) { return f != companyId });
            }

            that.setValue(val);
        });

        if(valueItem.length > 0 && valueItem.hasClass('select')){
            valueItem.removeClass('select');
        }

        el.remove();
    },

    setValue: function(value){
        BX24.placement.call('setValue', value);
    },

    setMultipleValue(val){
        that = this;

        promisVal = this.getValue();
        promisVal.then(function(data){
            if(data.indexOf(val) === -1){
                data.push(val);
                that.setValue(data);
            }
        });
    },

    getValue: function(){
        return new Promise(function(resolve, reject){
            BX24.placement.call('getValue', function(value){
                resolve(value);
            });
        });
    }
}