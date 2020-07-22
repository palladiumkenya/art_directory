var LiveSearchSelect = {
    fetchSchool: function() {
        this.mySelect2($('#school-id'), 'Select School');
    },
    fetchAllAccounts: function() {
        this.mySelect2($('#account-mf-id'), 'Search Account by first, middle or surname');
    },
    mySelect2: function(selectObj, placeholder) {
        selectObj.select2({
            placeholder: placeholder,
            allowClear: true,
            minimumInputLength: 2,
            width: '100%',
            ajax: {
                url: selectObj.attr('source'),
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    return query;
                },
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.items
                    };
                }
            }
        });
    },
    mySelect2CustomSource: function(selectObj, placeholder, source) {
        selectObj.select2({
            placeholder: placeholder,
            allowClear: true,
            minimumInputLength: 2,
            width: '100%',
            ajax: {
                url: source,
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    return query;
                },
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.items
                    };
                }
            }
        });
    }
};