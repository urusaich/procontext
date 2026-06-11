import "@typespec/http";

using Http;

@service(#{ title: "Short links Service" })
namespace LinksService;

@tag("Web")
interface Web {
    @summary("Переход по короткой ссылке")
    @route("{code}") @get op go(@path code: string): Response<302> | Response<404>;
}

@route("/api/links")
@tag("Links")
interface Links {
  @summary("Создание короткой ссылки")
  @post op create(@body body: {url: string}): {code: string, short_url: string} | Response<422>;

  @summary("Статистика по ссылке")
  @route("{code}/stats") @get op stats(@path code: string): {
    url: string = "https://google.com/";
    code: string = "38dmdu";
    clicks: numeric = 42;
    created_at: utcDateTime;
  } | Response<404>;
}
